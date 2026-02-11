<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();
        $role = $user->role;

        $data = [
            'role' => $role,
        ];

        if ($role === 'admin') {
            $data['categoriesCount'] = Category::count();
            $data['booksCount'] = Book::count();
            $data['membersCount'] = User::where('role', 'member')->count();
            $data['librariansCount'] = User::where('role', 'librarian')->count();
            $data['pendingBorrowsCount'] = Borrow::where('status', Borrow::STATUS_PENDING)->count();
            $data['recentBorrows'] = Borrow::with(['book', 'user'])->latest('requested_at')->limit(5)->get();
        } elseif ($role === 'librarian') {
            $data['pendingBorrowsCount'] = Borrow::where('status', Borrow::STATUS_PENDING)->count();
            $data['booksCount'] = Book::count();
            $data['recentBorrows'] = Borrow::with(['book', 'user'])->latest('requested_at')->limit(5)->get();
        } else {
            $data['myBorrowsCount'] = Borrow::where('user_id', $user->id)->count();
            $data['myPendingCount'] = Borrow::where('user_id', $user->id)->where('status', Borrow::STATUS_PENDING)->count();
            $data['recentBorrows'] = Borrow::where('user_id', $user->id)->with('book')->latest('requested_at')->limit(5)->get();
        }

        return view('dashboard', $data);
    }
}
