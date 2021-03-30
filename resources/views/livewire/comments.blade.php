<div class="flex justify-center">
    <div class="w-6/12">
        <h1 class="my-2 text-3xl">Comments</h1>

        @if ($errors->any())
            <div class="my-2 p-3 bg-red-300 text-red-700">
                {!! implode('', $errors->all('<span class="text-xs">:message</span>')) !!}
            </div>
        @endif

        @if(session()->has('message'))
            <div class="p-3 bg-green-300 text-green-700">
                {{ session('message') }}
            </div>
        @endif

        <div class="">
            @if ($image)
            <img src="{{ $image }}" alt="Uploaded image">
            @endif
            <input type="file" id="image" wire:change="$emit('fileChosen')">
        </div>

        <form class="my-4 flex" wire:submit.prevent="addComment">
            <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in your mind." wire:model.debounce.500ms="newComment">
            <div class="py-2">
                <button class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
            </div>
        </form>
        @foreach($comments as $comment)
            <div class="rounded border shadow p-3 my-2">
                <div class="flex justify-between my-2">
                    <div class="flex">
                        <p class="font-bold text-lg">{{$comment->user->name}}</p>
                        <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$comment->created_at->diffForHumans()}}</p>
                    </div>
                    <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$comment->id}})"></i>
                </div>
                <p class="text-gray-800">{{$comment->body}}</p>
                @if ($comment->image)
                    <img src="{{ $comment->imagePath }}" alt="Comment image">
                @endif
            </div>
        @endforeach

        {{ $comments->links() }}
    </div>
</div>

@section('js')
<script>
    window.livewire.on('fileChosen', postId => {
        let inputFile = document.getElementById('image');
        let file = inputFile.files[0];
        let reader = new FileReader();

        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result);
        };

        reader.readAsDataURL(file);
    })
</script>
@endsection
