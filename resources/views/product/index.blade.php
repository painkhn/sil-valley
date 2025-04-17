@extends('layouts.app')

@section('content')
    <div class="max-w-6xl w-full mx-auto space-y-8">
        <section class="flex items-center">
            <div class="w-2/5">
                @if (isset($computer->image))
                    <img src="{{ asset('storage/' . $computer->image) }}" alt="{{ $computer->name ?? 'Компьютер' }}"
                        class="max-w-[400px] w-full block rounded-md {{ isset($computer->deleted_at) ? 'opacity-50' : '' }}">
                @else
                    <div
                        class="max-w-[250px] h-[150px] w-full mx-auto rounded-md {{ isset($computer->deleted_at) ? 'bg-gray-900' : 'bg-gray-800' }} flex items-center justify-center">
                        <svg class="w-16 h-16 {{ isset($computer->deleted_at) ? 'text-gray-700' : 'text-gray-600' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                @endif
            </div>
            <div class="w-3/5">
                <div class="w-2/3 space-y-4">
                    <div class="flex items-center justify-between">
                        <h1 class="font-black text-5xl text-black dark:text-white">{{ $computer->name }}</h1>
                        <p class="text-2xl font-bold text-green-500">
                            {{ $computer->price }} ₽
                        </p>
                    </div>
                    @if (isset($computer->deleted_at))
                        <p class="text-lg font-semibold text-justify dark:text-white/80 text-black/80">
                            Товар удален
                        </p>
                    @endif
                    <p class="text-lg font-semibold text-justify dark:text-white/80 text-black/80">
                        {{ $computer->description }}
                    </p>
                    <div class="flex items-center gap-2">
                        <div class="flex items-center gap-2">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="text" name="computer" id="computer" value="{{ $computer->id }}"
                                    class="hidden">
                                <button
                                    class="px-4 py-2 bg-green-500 font-semibold dark:text-black/90 text-white rounded-md transition-all hover:bg-green-400">
                                    В корзину
                                </button>
                            </form>
                            <button
                                class="px-4 py-2 bg-green-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-green-400">
                                <svg class="w-6 h-6 transition-all dark:text-black text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                                </svg>
                            </button>
                        </div>
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <div class="w-3/5 flex items-center gap-2">
                                    @if (isset($computer->deleted_at))
                                        <form action="{{ route('admin.computer.restore', $computer->id) }}" method="POST" class="w-1/2">
                                            @csrf
                                            @method('PUT')
                                            <button
                                                class="w-full py-2 bg-red-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-red-400">
                                                Восстановить
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('admin.computer.edit', $computer->id) }}" class="w-1/2">
                                            <button
                                                class="w-full py-2 bg-blue-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-blue-400">
                                                Редактировать
                                            </button>
                                        </a>
                                        <form class="w-1/2" action="{{ route('admin.computer.destroy', $computer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="w-full py-2 bg-red-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-red-400">
                                                Удалить
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                {{ null }}
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </section>
        <section class="space-y-4">
            <h2 class="text-2xl font-semibold text-center text-black dark:text-white">Характеристики</h2>
            <ul class="space-y-4">
                @if (isset($computer->components) && count($computer->components) > 0)
                    @foreach ($computer->components as $component)
                        <li class="font-mono w-full {{ isset($computer->deleted_at) ? 'text-red-300/70' : 'text-white' }}">
                            <div
                                class="w-full flex p-4 border dark:border-white/40 border-black/40 rounded-md transition-all hover:bg-black/10 dark:hover:bg-white/10">
                                <div class="w-1/5 text-xl text-black dark:text-white">{{ $component->type }}</div>
                                <div class="line-clamp-1 text-xl dark:text-green-500 text-green-600">
                                    {{ $component->name }}
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="font-mono {{ isset($computer->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                        {{ $computer->cpu ?? 'CPU: Н/Д' }}
                    </li>
                    <li class="font-mono {{ isset($computer->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                        {{ $computer->ram ?? 'RAM: Н/Д' }}
                    </li>
                    <li class="font-mono {{ isset($computer->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                        {{ $computer->storage ?? 'Storage: Н/Д' }}
                    </li>
                @endif
            </ul>
        </section>
    </div>
@endsection
