<?php

namespace App\Http\Livewire;

// use App\Policies\TicketPolicy;
use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketManager extends Component
{
    public $tickets;
    public $users;
    public $problemDescription;
    public $receivedDate;
    public $affectedUser;
    public $additionalNotes;
    public $createTicket;
    public $selectTicket;

    protected $listeners = ['ticketRefresh'=>'ticketsRefresh'];

    public function mount(){
        $this->createTicket = false;
        $this->selectTicket = false;
    }

    public function render()
    {
        $this->tickets = Ticket::all();
        $this->users = User::all();
        return view('livewire.ticket-manager');
    }

    public function ticketsRefresh(){
        $this->tickets = Ticket::all();
    }

    public function deleteTicket($ticketId)
    {

        $ticket = Ticket::findOrFail($ticketId);
        $user = Auth::user();

        if(!$user->can('delete', Ticket::class)){
            // $this->emit('ticketCreated', ['message' => 'No Permission!']);
            abort(403);
            return false;
        }else if(!$ticket){
            // $this->emit('ticketCreated', ['message' => 'No Ticket!']);
            abort(403);
            return false;
        }
        $ticket->is_deleted = true;
        $ticket->save();

    }

    public function restoreTicket($ticketId)
    {

        $ticket = Ticket::findOrFail($ticketId);
        $user = Auth::user();
        if(!$user->can('restore', Ticket::class)){
            // $this->emit('ticketCreated', ['message' => 'No Permission!']);
            abort(403);
            return false;
        }else if(!$ticket){
            // $this->emit('ticketCreated', ['message' => 'No Ticket!']);
            abort(403);
            return false;
        }

        $ticket->is_deleted = false;
        $ticket->save();

    }

    public function openTicketForm(){
        $this->createTicket = !$this->createTicket;
    }

    public function selectTicket($id){
        if(Ticket::findOrFail($id)){
            $this->selectTicket = $id;
            $this->emit('selectedTicket', $id);
        }else{
            $this->selectTicket = false;
            $this->emit('selectedTicket', false);
        }
    }

    public function createTicket()
    {
        $this->validate([
            'problemDescription' => 'required',
            'receivedDate' => 'required|date|before_or_equal:today',
            'affectedUser' => 'required',
            'additionalNotes' => 'nullable|max:128',
        ]);

        $user = Auth::user();
        if(!$user->can('create', Ticket::class)){
            // $this->emit('ticketCreated', ['message' => 'No Permission!']);
            abort(403);
            return false;
        }

        Ticket::create([
            'problem_description' => $this->problemDescription,
            'received_date' => $this->receivedDate,
            'affected_user' => $this->affectedUser,
            'additional_notes' => $this->additionalNotes,
        ]);

        // Clear the form fields after creating the ticket
        $this->problemDescription = '';
        $this->receivedDate = '';
        $this->affectedUser = '';
        $this->additionalNotes = '';
        
        // Refresh the ticket list
        $this->tickets = Ticket::all();

        // Reset the form fields
        $this->resetFields();
        $this->createTicket = false;

        $this->emit('ticketCreated', ['message' => 'Create Done!']);
    }

    private function resetFields()
    {
        $this->problemDescription = '';
        $this->receivedDate = '';
        $this->affectedUser = '';
        $this->additionalNotes = '';
    }
}
