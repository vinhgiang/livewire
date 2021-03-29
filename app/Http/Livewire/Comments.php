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

    public function addComment()
    {
        if (empty($this->newComment) === false) {

            $storedComment = Comment::create([
                'body'    => $this->newComment,
                'user_id' => 1
            ]);

            $this->comments->prepend($storedComment);
            $this->newComment = '';
        }
    }
}
