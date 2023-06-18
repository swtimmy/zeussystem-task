<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketDetailManagement extends Component
{
    public $ticket;

    protected $listeners = ['selectedTicket','ticketRefresh'];

    public function selectedTicket($id){
        $this->ticket = Ticket::where('id',$id)->where('is_deleted',Ticket::ACTIVE)->first();
    }

    public function ticketRefresh($id){
        $this->ticket = Ticket::where('id',$id)->where('is_deleted',Ticket::ACTIVE)->first();
    }

    public function mount($id=false)
    {
        $this->ticket = Ticket::where('id',$id)->where('is_deleted',Ticket::ACTIVE)->first();
    }

    protected $rules = [
        'ticket.additional_notes' => 'nullable|max:128',
    ];

    public function changeTicketData(){
        $user = Auth::user();
        if(!$user->can('update', Ticket::class)){
            // $this->emit('ticketCreated', ['message' => 'No Permission!']);
            abort(403);
            return false;
        }
        $this->validate();
        $this->ticket->save();
        $this->emit('alert', ['message' => 'Updated']);
    }

    public function render()
    {
        $this->users = User::all();
        return view('livewire.ticket-detail-management');
    }
}
