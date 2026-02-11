<?php

namespace App\Policies;

use App\Models\Borrow;
use App\Models\User;

class BorrowPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Borrow $borrow): bool
    {
        return $user->id === $borrow->user_id || in_array($user->role, ['admin', 'librarian'], true);
    }

    public function create(User $user): bool
    {
        return $user->role === 'member';
    }

    /**
     * Approve, reject, or mark as returned (admin/librarian only).
     */
    public function manage(User $user, Borrow $borrow): bool
    {
        return in_array($user->role, ['admin', 'librarian'], true);
    }
}
