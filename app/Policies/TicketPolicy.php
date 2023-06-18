<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class TicketPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Allow all users to view tickets
        return true;
    }

    public function viewDeleted(User $user)
    {
        // Allow all users to view tickets
        return $user->isRole('admin') || $user->isRole('technician');
    }

    public function create(User $user)
    {
        // Only regular users can create tickets
        return $user->isRole('regular');
    }

    public function update(User $user)
    {
        // Only admin and technician users can update tickets
        return $user->isRole('admin') || $user->isRole('technician');
    }

    public function delete(User $user)
    {
        // Only admin and technician users can delete tickets
        return $user->isRole('admin') || $user->isRole('technician');
    }

    public function restore(User $user)
    {
        // Only admin and technician users can restore deleted tickets
        return $user->isRole('admin') || $user->isRole('technician');
    }
    
    public function forceDelete(User $user)
    {
        //
    }
}
