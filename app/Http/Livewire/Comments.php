<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        [
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi architecto aut cumque, eum in minima molestiae natus numquam quod recusandae repellat sed. Accusamus atque consequatur exercitationem laudantium non quaerat sequi!',
            'created_at' => '3 mins ago',
            'creator' => 'Vinh'
        ]
    ];

    public $newComment;

    public function render()
    {
        return view('livewire.comments');
    }

    public function addComment()
    {
        if (empty($this->newComment) === false) {
            array_unshift($this->comments, [
                'body' => $this->newComment,
                'created_at' => Carbon::now()->diffForHumans(),
                'creator' => 'Vinh'
            ]);

            $this->newComment = '';
        }
    }
}
