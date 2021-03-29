<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Livewire</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    @livewireStyles

</head>
<body>

    <livewire:counter />

    <div class="flex justify-center">
        <div class="w-10/12 my-10 flex">
            <div class="w-5/12 rounded border p-2">
                <livewire:tickets />
            </div>
            <div class="w-7/12 mx-2 rounded border p-2">
                @livewire('comments')
            </div>
        </div>
    </div>

    @livewireScripts

    @yield('js')
</body>
</html>
