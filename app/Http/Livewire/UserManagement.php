<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Role;

class UserManagement extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    public $users;
    public $roles;

    public function createUser()
    {
        $user = Auth::user();

        if(!$user->can('create', Comment::class)){
            abort(403);
            return false;
        }

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->role
        ]);

        $this->resetForm();

        session()->flash('message', 'User created successfully.');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function render()
    {
        $user = Auth::user();
        if(!$user->can('viewAny', User::class)){
            abort(403);
            return false;
        }

        $this->users = User::all();
        $this->roles = Role::all();
        
        return view('livewire.user-management');
    }
}
