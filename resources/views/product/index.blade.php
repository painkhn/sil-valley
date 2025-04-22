@extends('layouts.app')

@section('content')
    <div class="max-w-6xl w-full mx-auto space-y-8">
        <section class="flex items-center max-[768px]:flex-col">
            <div class="w-2/5 max-[768px]:mb-4 max-[768px]:w-full">
                @if (isset($computer->image))
                    <img src="{{ asset('storage/' . $computer->image) }}" alt="{{ $computer->name ?? 'Компьютер' }}"
                        class="max-w-[400px] max-[768px]:mx-auto w-full block rounded-md {{ isset($computer->deleted_at) ? 'opacity-50' : '' }}">
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
            <div class="w-3/5 max-[768px]:w-full">
                <div class="w-2/3 max-[400px]:w-full space-y-4 max-[768px]:mx-auto">
                    <div class="flex items-center justify-between gap-y-2 max-[500px]:flex-col">
                        <h1 class="font-black text-5xl text-black dark:text-white">{{ $computer->name }}</h1>
                        <p class="text-2xl max-[768px]:text-4xl font-bold text-green-500">
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
                    <div class="space-y-2">
                        <div class="flex items-center max-[500px]:justify-center gap-2">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="text" name="computer" id="computer" value="{{ $computer->id }}"
                                    class="hidden">
                                <button
                                    class="px-4 py-2 bg-green-500 font-semibold dark:text-black/90 text-white rounded-md transition-all hover:bg-green-400">
                                    В корзину
                                </button>
                            </form>
                            <form action="{{ route('comparison.store') }}" method="POST">
                                @csrf
                                <input type="text" name="computer" id="computer" value="{{ $computer->id }}"
                                    class="hidden">
                                <button
                                    class="px-4 py-2 bg-green-500 font-semibold dark:text-black text-white rounded-md transition-all hover:bg-green-400">
                                    <svg class="w-6 h-6 transition-all dark:text-black text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                                    </svg>
                                </button>
                            </form>
                            <form method="POST" action="{{ route('favorites.store', $computer->id) }}">
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
                        <div class="max-[400px]:justify-center max-[400px]:flex max-[400px]:w-full">
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    <div class="w-[280px] flex items-center gap-2">
                                        @if (isset($computer->deleted_at))
                                            <form action="{{ route('admin.computer.restore', $computer->id) }}" method="POST"
                                                class="w-1/2 max-[500px]:mx-auto">
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
                                            <form class="w-1/2" action="{{ route('admin.computer.destroy', $computer->id) }}"
                                                method="POST">
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
            </div>
        </section>
        <section class="space-y-4">
            <h2 class="text-2xl font-semibold text-center text-black dark:text-white">Характеристики</h2>
            <ul class="space-y-4">
                @if (isset($computer->components) && count($computer->components) > 0)
                    @foreach ($computer->components as $component)
                        <li class="font-mono w-full {{ isset($computer->deleted_at) ? 'text-red-300/70' : 'text-white' }}">
                            <div
                                class="w-full  flex p-4 gap-x-4 border dark:border-white/40 border-black/40 rounded-md transition-all hover:bg-black/10 dark:hover:bg-white/10">
                                <div class="w-1/5 max-[768px]:w-[40%] text-xl max-[768px]:text-lg text-black dark:text-white line-clamp-1">
                                    @if ($component->type === 'CPU')
                                        Процессор
                                    @elseif ($component->type === 'RAM')
                                        ОЗУ
                                    @elseif ($component->type === 'GPU')
                                        Видеокарта
                                    @elseif ($component->type === 'STORAGE')
                                        Память
                                    @elseif ($component->type === 'MOTHERBOARD')
                                        Материнская плата
                                    @elseif ($component->type === 'PSU')
                                        Блок питания
                                    @elseif ($component->type === 'CASE')
                                        Корпус
                                    @endif
                                </div>
                                <div class="line-clamp-1 max-[768px]:w-[60%] max-[530px]:text-right text-xl max-[768px]:text-lg dark:text-green-500 text-green-600">
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
