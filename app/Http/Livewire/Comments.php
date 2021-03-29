<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function render()
    {
        return view('livewire.comments');
    }

    public function mount($comments)
    {
        $this->comments = $comments;
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

        $storedComment = Comment::create([
            'body'    => $this->newComment,
            'user_id' => 1
        ]);

        $this->comments->prepend($storedComment);
        $this->newComment = '';
    }
}
