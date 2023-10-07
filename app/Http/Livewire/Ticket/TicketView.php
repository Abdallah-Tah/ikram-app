<?php

namespace App\Http\Livewire\Ticket;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TicketComment;
use Illuminate\Support\Facades\Auth;

class TicketView extends Component
{
    use WithPagination;

    public $ticketId, $commentId;
    public $name, $comment;
    public $search;
    public $sortBy = 'id';
    public $sortDirection = 'asc';
    public $sortAsc = true;
    public $perPage = 10;
    public $page = 1;
    public $ticket;
    public $showEditTicketCommentModal = false;
    public $showDeleteTicketCommentModal = false;


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function mount($ticketId)
    {
        $this->ticketId = $ticketId;
        $this->ticket = Ticket::find($ticketId);
    }

    public function showDeleteTicketCommentModal($id)
    {
        $this->resetFields();
        $this->commentId = $id;
        $this->comment = TicketComment::find($id)->comment;
        $this->showDeleteTicketCommentModal = true;
    }

    public function render()
    {
        //$ticket = Auth::user()->tickets()->find($this->ticketId);
        $ticketComments = TicketComment::where('ticket_id', $this->ticketId)->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);

        return view('livewire.ticket.ticket-view', [
            // 'ticket' => $ticket,
            'ticketComments' => $ticketComments
        ]);
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

        $ticket = Ticket::find($this->ticketId);
        $ticket->ticketComments()->create([
            'comment' => $this->comment,
            'user_id' => Auth::user()->id
        ]);
        $this->resetFields();
        $this->dispatchBrowserEvent('notify', 'Comment added successfully!');
    }

    public function hideShowEditTicketCommentModal()
    {
        $this->resetFields();

        $this->showEditTicketCommentModal = false;
    }


    public function deleteTicketComment()
    {
        $ticketComment = TicketComment::find($this->commentId);
        $ticketComment->delete();

        $this->resetFields();
        $this->showDeleteTicketCommentModal = false;
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

    public function showEditTicketCommentModal($id)
    {
        $ticketComment = TicketComment::find($id);
        $this->commentId = $ticketComment->id; // Fixed this line
        $this->comment = $ticketComment->comment;
        $this->showEditTicketCommentModal = true;
    }


    public function updateTicketComment()
    {
        $this->validate([
            'comment' => 'required',
        ]);

        $ticketComment = TicketComment::find($this->commentId); // Use commentId here
        $ticketComment->update([
            'comment' => $this->comment,
            'user_id' => Auth::user()->id
        ]);
        $this->resetFields();
        $this->showEditTicketCommentModal = false;
        $this->dispatchBrowserEvent('notify', 'Comment updated successfully!');
    }


}
