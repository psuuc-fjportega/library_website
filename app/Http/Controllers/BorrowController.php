<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Notifications\BorrowApprovedNotification;
use App\Notifications\BorrowRejectedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BorrowController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Borrow::class);
        $user = $request->user();

        $borrows = Borrow::query()
            ->with(['book.category', 'user', 'approvedByUser'])
            ->when($user->role === 'member', fn ($q) => $q->where('user_id', $user->id))
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->orderByDesc('requested_at')
            ->paginate(15)
            ->withQueryString();

        return view('borrows.index', ['borrows' => $borrows]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Borrow::class);

        $request->validate(['book_id' => ['required', 'exists:books,id']]);

        $book = Book::findOrFail($request->integer('book_id'));

        if ($book->available_quantity < 1) {
            return back()->withErrors(['book_id' => __('This book is not available to borrow.')]);
        }

        $existing = Borrow::where('user_id', $request->user()->id)
            ->where('book_id', $book->id)
            ->whereIn('status', [Borrow::STATUS_PENDING, Borrow::STATUS_APPROVED])
            ->exists();

        if ($existing) {
            return back()->withErrors(['book_id' => __('You already have a pending or active borrow for this book.')]);
        }

        Borrow::create([
            'user_id' => $request->user()->id,
            'book_id' => $book->id,
            'status' => Borrow::STATUS_PENDING,
        ]);

        return redirect()->route('borrows.index')->with('status', __('Borrow request submitted.'));
    }

    public function approve(Borrow $borrow): RedirectResponse
    {
        $this->authorize('manage', $borrow);

        if (! $borrow->isPending()) {
            return redirect()->route('borrows.index')->withErrors(['borrow' => __('This request can no longer be approved.')]);
        }

        if ($borrow->book->available_quantity < 1) {
            return redirect()->route('borrows.index')->withErrors(['borrow' => __('Book is no longer available.')]);
        }

        $dueDate = now()->addDays(config('library.borrow_days', 14));

        $borrow->update([
            'status' => Borrow::STATUS_APPROVED,
            'approved_at' => now(),
            'approved_by' => request()->user()->id,
            'due_date' => $dueDate,
        ]);

        $borrow->book->decrement('available_quantity');

        $borrow->user->notify(new BorrowApprovedNotification($borrow->fresh(['book'])));

        return redirect()->route('borrows.index')->with('status', __('Borrow approved.'));
    }

    public function reject(Borrow $borrow): RedirectResponse
    {
        $this->authorize('manage', $borrow);

        if (! $borrow->isPending()) {
            return redirect()->route('borrows.index')->withErrors(['borrow' => __('This request can no longer be rejected.')]);
        }

        $borrow->update(['status' => Borrow::STATUS_REJECTED]);

        $borrow->user->notify(new BorrowRejectedNotification($borrow->fresh(['book'])));

        return redirect()->route('borrows.index')->with('status', __('Borrow rejected.'));
    }

    public function markReturned(Borrow $borrow): RedirectResponse
    {
        $this->authorize('manage', $borrow);

        if (! $borrow->isApproved()) {
            return redirect()->route('borrows.index')->withErrors(['borrow' => __('Only approved borrows can be marked as returned.')]);
        }

        $borrow->update([
            'status' => Borrow::STATUS_RETURNED,
            'returned_at' => now(),
        ]);

        $borrow->book->increment('available_quantity');

        return redirect()->route('borrows.index')->with('status', __('Book marked as returned.'));
    }
}
