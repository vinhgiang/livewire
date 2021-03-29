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

    protected $listeners = ['fileUpload' => 'handleFileUpload'];

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

        $image = $this->storeImage();

        Comment::create([
            'body'    => $this->newComment,
            'image'   => $image,
            'user_id' => 1
        ]);

        $this->newComment = '';
        $this->image      = '';

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
        if ($this->image === false) {
            return null;
        }

        $img  = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';

        Storage::disk('public')->put($name, $img);

        return $name;
    }
}
