<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AddComment extends Component
{

    public $comment;
    public $ticketId;

    public function addComment()
    {
        $this->validate([
            'comment' => 'required|max:255',
        ]);

        $user = Auth::user();

        if(!$user->can('create', Comment::class)){
            // $this->emit('commentAdded', ['message' => 'No Permission!']);
            abort(403);
            return false;
        }

        $newComment = Comment::create([
            'content' => $this->comment,
            'user_id' => auth()->id(),
            'ticket_id' => $this->ticketId,
        ]);

        $this->comment = '';

        $this->emit('commentAdded', ['message' => 'Comment Added!']);
        $this->emit('ticketRefresh', $this->ticketId);
    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
