<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Livewire\TicketManager;
use Livewire\Livewire;

class TicketTest extends TestCase
{
    public function test_admin_access_home_page()
    {
        $user = User::where("role_id",1)->first();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_technician_access_home_page()
    {
        $user = User::where("role_id",2)->first();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }

    public function test_regular_access_home_page()
    {
        $user = User::where("role_id",3)->first();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }
    public function test_admin_create_ticket()
    {
        $user = User::where("role_id",1)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->set('problemDescription', 'Hihi')
            ->set('receivedDate', '2023-06-18')
            ->set('affectedUser', 2)
            ->set('additionalNotes', 'test')
            ->call('createTicket')
            ->assertStatus(403);
    }
    public function test_technician_create_ticket()
    {
        $user = User::where("role_id",2)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->set('problemDescription', 'Hihi')
            ->set('receivedDate', '2023-06-18')
            ->set('affectedUser', 2)
            ->set('additionalNotes', 'test')
            ->call('createTicket')
            ->assertStatus(403);
    }
    public function test_regular_create_ticket()
    {
        $user = User::where("role_id",3)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->set('problemDescription', 'Hihi')
            ->set('receivedDate', '2023-06-18')
            ->set('affectedUser', 2)
            ->set('additionalNotes', 'test')
            ->call('createTicket')
            ->assertStatus(200);
    }
    public function test_admin_delete_ticket()
    {
        $user = User::where("role_id",1)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->call('deleteTicket',1)
            ->assertStatus(200);
    }
    public function test_technician_delete_ticket()
    {
        $user = User::where("role_id",2)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->call('deleteTicket',1)
            ->assertStatus(200);
    }
    public function test_regular_delete_ticket()
    {
        $user = User::where("role_id",3)->first();

        $response = $this->actingAs($user);
        
        Livewire::test(TicketManager::class)
            ->call('deleteTicket',1)
            ->assertStatus(403);
    }
}
