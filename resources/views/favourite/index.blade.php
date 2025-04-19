@extends('layouts.app')

@section('content')
    <section class="max-w-6xl w-full mx-auto">
        <h1 class="mb-10 text-center font-semibold text-2xl text-black dark:text-white">
            Избранные товары
        </h1>
        <ul class="grid grid-cols-3 w-full gap-y-5">
            @foreach ($favorite as $item)
                <li class="max-w-[300px] w-full justify-self-center">
                    <x-computer-card :item="$item->computer" />
                </li>
            @endforeach
        </ul>
    </section>
@endsection
