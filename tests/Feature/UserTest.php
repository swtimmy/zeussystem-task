<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Livewire\TicketManager;
use Livewire\Livewire;

class UserTest extends TestCase
{
    public function test_admin_access_user_page()
    {
        $user = User::where("role_id",1)->first();

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(200);
    }

    public function test_technician_access_user_page()
    {
        $user = User::where("role_id",2)->first();

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(403);
    }

    public function test_regular_access_user_page()
    {
        $user = User::where("role_id",3)->first();

        $response = $this->actingAs($user)->get('/user');

        $response->assertStatus(403);
    }
}
