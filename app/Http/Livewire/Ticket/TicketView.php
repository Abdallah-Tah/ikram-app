<?php

namespace App\Http\Livewire\Ticket;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TicketView extends Component
{
    use WithPagination;

    public $ticketId;
    public $name, $comment;
    public $search;
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $sortAsc = true;
    public $perPage = 10;
    public $page = 1;
    protected $tickets;

    public $showModal = false;
    public $showDeleteModal = false;


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function mount($id)
    {
        $this->ticketId = $id;
    }

    public function showModal()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function showDeleteModal($id)
    {
        $this->ticketId = $id;
        $this->showDeleteModal = true;
    }

    public function render()
    {
        $ticket = Auth::user()->tickets()->find($this->ticketId);
        $ticketComments = $ticket->ticketComments()->orderBy('created_at', 'desc')->get();

        return view('livewire.ticket.ticket-view', [
            'ticket' => $ticket,
            'ticketComments' => $ticketComments
        ]);
    }

    public function delete()
    {
        $ticket = Auth::user()->tickets()->find($this->ticketId);
        $ticket->delete();
        $this->showDeleteModal = false;
        $this->emit('ticketDeleted');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function updatingPage()
    {
        $this->resetPage();
    }

    public function updatingSortBy()
    {
        $this->resetPage();
    }

    public function updatingSortDirection()
    {
        $this->resetPage();
    }

    public function updatingSortAsc()
    {
        $this->resetPage();
    }

    public function storeTicketComment()
    {
        $this->validate([
            'comment' => 'required',
        ]);

        $ticket = Auth::user()->tickets()->find($this->ticketId);
        $ticket->ticketComments()->create([
            'comment' => $this->comment,
            'user_id' => Auth::user()->id
        ]);
        $this->resetFields();
        $this->dispatchBrowserEvent('notify', 'Comment added successfully!');
    }

    public function deleteTicketComment($id)
    {
        $ticket = Auth::user()->tickets()->find($this->ticketId);
        $ticketComment = $ticket->ticketComments()->find($id);
        $ticketComment->delete();
        $this->dispatchBrowserEvent('notify', 'Comment deleted successfully!');
    }

    //reset fields
    public function resetFields()
    {
        $this->comment = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'comment' => 'required',
        ]);
    }
}
