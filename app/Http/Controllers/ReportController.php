<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function __invoke(Request $request): View
    {
        $this->authorize('viewAny', Borrow::class);

        if (! in_array($request->user()->role, ['admin', 'librarian'], true)) {
            abort(403);
        }

        $borrowStats = [
            'total' => Borrow::count(),
            'pending' => Borrow::where('status', Borrow::STATUS_PENDING)->count(),
            'approved' => Borrow::where('status', Borrow::STATUS_APPROVED)->count(),
            'rejected' => Borrow::where('status', Borrow::STATUS_REJECTED)->count(),
            'returned' => Borrow::where('status', Borrow::STATUS_RETURNED)->count(),
        ];

        $mostBorrowed = Borrow::query()
            ->selectRaw('book_id, count(*) as borrow_count')
            ->groupBy('book_id')
            ->orderByDesc('borrow_count')
            ->limit(10)
            ->with('book')
            ->get();

        $activeMembers = User::query()
            ->where('role', 'member')
            ->whereHas('borrows', fn ($q) => $q->where('requested_at', '>=', now()->subDays(30)))
            ->withCount(['borrows' => fn ($q) => $q->where('requested_at', '>=', now()->subDays(30))])
            ->orderByDesc('borrows_count')
            ->limit(10)
            ->get();

        return view('reports.index', [
            'borrowStats' => $borrowStats,
            'mostBorrowed' => $mostBorrowed,
            'activeMembers' => $activeMembers,
        ]);
    }
}
