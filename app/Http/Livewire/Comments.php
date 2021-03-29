<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;

    public $newComment;

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
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

        Comment::create([
            'body'    => $this->newComment,
            'user_id' => 1
        ]);

        $this->newComment = '';

        session()->flash('message', 'comment added successfully :)');
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();

        session()->flash('message', 'comment deleted successfully');
    }
}
