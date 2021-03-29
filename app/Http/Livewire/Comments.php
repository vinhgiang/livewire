<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $newComment;
    public $image;
    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected'
    ];

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2)
        ]);
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'newComment' => 'required|max:255'
        ]);
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|max:255'
        ]);

        if ($this->ticketId == null) {
            $this->addError('ticketId', 'Please select a ticket.');
            return;
        }

        $image = $this->storeImage();

        Comment::create([
            'body'              => $this->newComment,
            'image'             => $image,
            'support_ticket_id' => $this->ticketId,
            'user_id'           => 1,
        ]);

        $this->newComment = '';
        $this->image      = null;

        session()->flash('message', 'comment added successfully :)');
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();

        session()->flash('message', 'comment deleted successfully');
    }

    public function handleFileUpload($base64Img)
    {
        $this->image = $base64Img;
    }

    public function storeImage()
    {
        if (isset($this->image) === false || empty($this->image)) {
            return null;
        }

        $img  = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';

        Storage::disk('public')->put($name, $img);

        return $name;
    }

    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }
}
