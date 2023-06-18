<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class CommentPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Allow all users to view Comments
        return true;
    }

    public function create(User $user)
    {
        // Only regular users can create Comments
        return $user->isRole('admin') || $user->isRole('technician');
    }

    public function update(User $user)
    {
        // Only admin and technician users can update Comments
        return false;
    }

    public function delete(User $user)
    {
        // Only admin and technician users can delete Comments
        return false;
    }

    public function restore(User $user)
    {
        // Only admin and technician users can restore deleted Comments
        return false;
    }
    
    public function forceDelete(User $user)
    {
        //
    }
}
