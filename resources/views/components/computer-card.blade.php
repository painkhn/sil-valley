@props(['item', 'variant' => 'default'])

<a href="{{ route('computer.show', $item->id) }}" class="w-max">
    <div
        class="p-7 {{ isset($item->deleted_at) ? 'border border-red-500/50' : '' }} rounded-md space-y-4 text-center transition-all hover:scale-105 shadow-lg {{ isset($item->deleted_at) ? 'bg-[#2a1a1a]/80' : 'dark:bg-[#1f1f1f]/80' }} dark:shadow-black shadow-black/40 relative">

        @if (isset($item->deleted_at))
            <div class="absolute top-2 right-2 bg-red-500/80 text-white text-xs px-2 py-1 rounded-full font-mono">
                Удален {{ $item->deleted_at->format('d.m.Y') }}
            </div>
        @endif

        @if (isset($item->image))
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name ?? 'Компьютер' }}"
                class="h-[250px] w-full block mx-auto rounded-md {{ isset($item->deleted_at) ? 'opacity-50' : '' }}">
        @else
            <div
                class="max-w-[250px] h-[150px] w-full mx-auto rounded-md {{ isset($item->deleted_at) ? 'bg-gray-900' : 'bg-gray-800' }} flex items-center justify-center">
                <svg class="w-16 h-16 {{ isset($item->deleted_at) ? 'text-gray-700' : 'text-gray-600' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        @endif

        <div class="space-y-2 text-left">
            <h3 class="text-lg font-semibold {{ isset($item->deleted_at) ? 'text-white/70' : 'dark:text-white text-black' }}">
                {{ $item->title ?? ($item->name ?? 'Компьютер') }}
            </h3>
            <p class="font-semibold text-2xl {{ isset($item->deleted_at) ? 'text-white/60' : 'dark:text-green-400 text-green-500' }}">
                {{ $item->price ?? '0' }} ₽
            </p>

            <div class="text-left {{ isset($item->deleted_at) ? 'text-white/70' : 'text-white/90' }} text-sm mt-3">
                <p class="{{ isset($item->deleted_at) ? 'text-red-400' : 'dark:text-white/90 text-black/80' }} font-mono mb-1 font-semibold text-lg">
                    Характеристики:
                </p>
                <ul class="space-y-1">
                    @if (isset($item->components) && count($item->components) > 0)
                        @foreach ($item->components as $component)
                            <li
                                class="font-mono w-full {{ isset($item->deleted_at) ? 'text-red-300/70' : 'dark:text-white/90 text-black/60' }}">
                                <div class="w-full flex">
                                    <div class="w-1/2">{{ $component->type }}</div>
                                    <div class="w-1/2 line-clamp-1">
                                        {{ $component->name }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <li class="font-mono {{ isset($item->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                            {{ $item->cpu ?? 'CPU: Н/Д' }}
                        </li>
                        <li class="font-mono {{ isset($item->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                            {{ $item->ram ?? 'RAM: Н/Д' }}
                        </li>
                        <li class="font-mono {{ isset($item->deleted_at) ? 'text-red-300/70' : 'text-green-300' }}">
                            {{ $item->storage ?? 'Storage: Н/Д' }}
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        @if ($variant == 'admin')
            <div class="flex justify-between pt-3">
                @if (isset($item->deleted_at))
                    <form action="{{ route('admin.computer.restore', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button
                            class="transition-all px-4 py-2 text-black rounded-md hover:opacity-80 font-semibold bg-blue-500">
                            Восстановить
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.computer.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            class="transition-all px-4 py-2 text-black rounded-md hover:opacity-80 font-semibold bg-green-500">
                            Удалить
                        </button>
                    </form>
                    <a href="{{ route('admin.computer.edit', $item->id) }}"
                        class="transition-all px-4 py-2 text-black rounded-md hover:opacity-80 font-semibold bg-green-500">
                        Редактировать
                    </a>
                @endif
            </div>
        @endif
    </div>
</a>
