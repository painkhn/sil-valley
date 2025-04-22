@extends('layouts.app')

@section('content')
    <section class="max-w-6xl w-full mx-auto space-y-10">
        <h1 class="text-center font-semibold text-2xl text-black dark:text-white">
            Избранные товары
        </h1>
        <button type="button" class="px-4 py-2 mx-auto block font-semibold bg-green-500 transition-all hover:bg-green-600 hover:dark:bg-green-400 rounded-xl dark:text-black">Удалить всё</button>
        <ul class="flex gap-10 flex-wrap max-[800px]:justify-center max-[800px]:gap-x-5 w-full gap-y-5">
            @foreach ($favorite as $item)
                <li class="max-w-[300px] max-[660px]:max-w-full w-full justify-self-center relative">
                    
                    <x-computer-card :item="$item->computer">
                        <div class="absolute top-2 right-2 z-20">
                            <form method="POST" action="{{ route('favorites.store', $item->id) }}">
                                @csrf
                                <button
                                    class="px-4 py-2 bg-green-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-green-400">
                                    @if ($isFavorite)
                                        <svg class="w-6 h-6 transition-all dark:text-black text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m12.75 20.66 6.184-7.098c2.677-2.884 2.559-6.506.754-8.705-.898-1.095-2.206-1.816-3.72-1.855-1.293-.034-2.652.43-3.963 1.442-1.315-1.012-2.678-1.476-3.973-1.442-1.515.04-2.825.76-3.724 1.855-1.806 2.201-1.915 5.823.772 8.706l6.183 7.097c.19.216.46.34.743.34a.985.985 0 0 0 .743-.34Z" />
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 transition-all dark:text-black text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </x-computer-card>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
