@extends('layouts.app')

@php
    $typeTranslations = [
        'CPU' => 'Процессор',
        'RAM' => 'Оперативная память',
        'GPU' => 'Видеокарта',
        'STORAGE' => 'Накопитель',
        'MOTHERBOARD' => 'Материнская плата',
        'PSU' => 'Блок питания',
        'CASE' => 'Корпус',
    ];

    $parameterTranslations = [
        'capacity' => 'Емкость',
        'base_clock' => 'Базовая частота',
        'cores' => 'Ядра',
        'threads' => 'Потоки',
        'speed' => 'Скорость',
        'clock' => 'Частота',
        'memory' => 'Память',
        'type' => 'Тип',
        'chipset' => 'Чипсет',
        'form_factor' => 'Форм-фактор',
        'efficiency' => 'Эффективность',
        'wattage' => 'Мощность',
    ];
@endphp

@section('content')
    @if ($computers->isEmpty())
        <section class="max-w-6xl w-full mx-auto space-y-10">
            <h1 class="text-center font-semibold text-2xl text-black dark:text-white">
                Сравнение компьютеров
            </h1>
            <div class="text-center text-gray-600 dark:text-gray-300 space-y-4">
                <p class="text-lg">Вы ещё не добавили товары в сравнение</p>
                <a href="{{ route('shop.index') }}"
                    class="inline-block px-6 py-2 bg-green-500 hover:bg-green-600 hover:dark:bg-green-400 text-white dark:text-black font-semibold rounded-xl transition-all">
                    Перейти к покупкам
                </a>
            </div>
        </section>
    @else
        <div class="flex justify-center gap-8 mb-10">
            @foreach ($computers as $computer)
                <div class="text-center relative">
                    <img src="{{ asset('storage/' . $computer->image) }}" class="w-[150px] mx-auto rounded-lg shadow">
                    <div class="mt-2 text-lg font-bold text-black dark:text-white">{{ $computer->name }}</div>
                    <div class="text-gray-600 dark:text-gray-300">{{ number_format($computer->price, 0, ',', ' ') }} ₽</div>

                    <!-- Кнопка удаления -->
                    <form action="{{ route('comparison.destroy', $computer->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-colors"
                            onclick="return confirm('Удалить компьютер из сравнения?')">
                            Удалить
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        @php
            $groupedParams = [];

            foreach ($computers as $computer) {
                foreach ($computer->components as $component) {
                    foreach ($component->parameters as $paramValue) {
                        $type = $component->type;
                        $name = $paramValue->parameter->name;

                        if (!isset($groupedParams[$type])) {
                            $groupedParams[$type] = [];
                        }

                        $groupedParams[$type][] = $name;
                    }
                }
            }

            foreach ($groupedParams as $type => $params) {
                $groupedParams[$type] = collect($params)->unique()->sort()->values();
            }
        @endphp

        @foreach ($groupedParams as $type => $params)
            <h2 class="text-xl font-bold mt-10 mb-2 text-black dark:text-white">
                Тип компонента: {{ $typeTranslations[$type] ?? $type }}
            </h2>

            <table class="min-w-full divide-y shadow-sm rounded-lg overflow-hidden mb-6">
                <thead class="bg-gray-100 dark:bg-white/20">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider border-b bg-black/5 border-gray-200 dark:border-white/20">
                            Характеристика</th>
                        @foreach ($computers as $computer)
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider border-b bg-black/5 border-gray-200 dark:border-white/20">
                                {{ $computer->name }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-black divide-y divide-gray-200">
                    @foreach ($params as $paramName)
                        <tr class="hover:bg-gray-100 transition-colors duration-150 dark:hover:bg-white/10">
                            <td
                                class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white/90 border-b border-gray-200 dark:border-white/20">
                                {{ $parameterTranslations[$paramName] ?? $paramName }}</td>

                            @php
                                $values = [];

                                foreach ($computers as $computer) {
                                    $found = null;
                                    foreach ($computer->components as $component) {
                                        if ($component->type !== $type) {
                                            continue;
                                        }

                                        foreach ($component->parameters as $paramValue) {
                                            if ($paramValue->parameter->name === $paramName) {
                                                $found = $paramValue->value;
                                                break 2;
                                            }
                                        }
                                    }
                                    $values[] = $found;
                                }

                                $highlight = [];
                                $isNumeric = is_numeric($values[0]);

                                if ($isNumeric) {
                                    $maxValue = max($values);
                                    $minValue = min($values);

                                    foreach ($values as $value) {
                                        if ($value == $maxValue) {
                                            $highlight[] = 'green';
                                        } elseif ($value == $minValue) {
                                            $highlight[] = 'red';
                                        } else {
                                            $highlight[] = 'neutral';
                                        }
                                    }
                                } else {
                                    $highlight = array_fill(0, count($values), 'neutral');
                                }
                            @endphp

                            @foreach ($values as $index => $val)
                                <td
                                    class="px-6 py-4 text-sm text-center border-b border-gray-200 dark:border-white/20
                                    @if ($highlight[$index] === 'green') text-green-600 font-bold bg-green-500/10
                                    @elseif ($highlight[$index] === 'red') text-red-600 font-bold bg-red-500/10
                                    @else text-gray-500 dark:text-white/60 @endif">
                                    {{ $val ?? '—' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endif
@endsection
