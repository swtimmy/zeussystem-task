<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Allow all users to view Users
        return $user->isRole('admin');
    }

    public function create(User $user)
    {
        // Only regular users can create Users
        return $user->isRole('admin');
    }

    public function update(User $user)
    {
        // Only admin and technician users can update Users
        return false;
    }

    public function delete(User $user)
    {
        // Only admin and technician users can delete Users
        return false;
    }

    public function restore(User $user)
    {
        // Only admin and technician users can restore deleted Users
        return false;
    }
    
    public function forceDelete(User $user)
    {
        //
    }
}
