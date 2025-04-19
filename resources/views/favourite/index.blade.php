@extends('layouts.app')

@section('content')
    <section class="flex justify-between">
        <ul class="grid grid-cols-4 w-full gap-y-5">
            @foreach ($favorite as $item)
                <x-computer-card :item="$item->computer" />
            @endforeach
        </ul>
    </section>
@endsection
