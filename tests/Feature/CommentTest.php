<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Http\Livewire\AddComment;
use Livewire\Livewire;

class CommentTest extends TestCase
{

     public function test_admin_create_comment()
     {
         $user = User::where("role_id",1)->first();
 
         $response = $this->actingAs($user);
         
         Livewire::test(AddComment::class)
            ->set('ticketId', 1)
            ->set('comment', 'test')
            ->call('addComment')
            ->assertStatus(200);
     }
     public function test_technician_create_comment()
     {
         $user = User::where("role_id",2)->first();
 
         $response = $this->actingAs($user);
         
         Livewire::test(AddComment::class)
            ->set('ticketId', 1)
            ->set('comment', 'test')
            ->call('addComment')
            ->assertStatus(200);
     }
     public function test_regular_create_comment()
     {
         $user = User::where("role_id",3)->first();
 
         $response = $this->actingAs($user);
         
         Livewire::test(AddComment::class)
            ->set('ticketId', 1)
            ->set('comment', 'test')
            ->call('addComment')
            ->assertStatus(403);
     }
}
