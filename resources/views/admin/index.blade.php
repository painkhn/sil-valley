@extends('layouts.app')

@section('content')
    <section class="w-1/3 mx-auto text-center space-y-8 pt-10">
        <p class="text-xl">Админка ептить</p>
    </section>

    <div class="w-[75%]">
        <ul class="grid grid-cols-4 w-full gap-y-5">
            @foreach ($pc_list as $item)
                <x-computer-card :item="$item" variant="admin" />
            @endforeach
        </ul>
    </div>
@endsection
