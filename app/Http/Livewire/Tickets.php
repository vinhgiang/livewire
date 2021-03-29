<?php

namespace App\Http\Livewire;

use App\Models\SupportTicket;
use Livewire\Component;

class Tickets extends Component
{
    public $activatedTicketId;

    protected $listeners = [
        'ticketSelected'
    ];

    public function render()
    {
        return view('livewire.tickets', [
            'tickets' => SupportTicket::all()
        ]);
    }

    public function ticketSelected($ticketId)
    {
        $this->activatedTicketId = $ticketId;
    }
}
