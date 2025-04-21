@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4 text-center text-black dark:text-white">Сравнение компьютеров</h1>

        <!-- <div class="grid grid-cols-3 gap-4">
            <div></div>
            @foreach ($computers as $computer)
                <div class="text-center font-semibold text-xl">{{ $computer->name }}</div>
            @endforeach
        </div> -->

        <table class="min-w-full divide-y shadow-sm rounded-lg overflow-hidden">
            <thead class="bg-gray-50 dark:bg-white/20">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider border-b border-gray-200 dark:border-white/20">Характеристика</th>
                    @foreach ($computers as $computer)
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-white uppercase tracking-wider border-b border-gray-200 dark:border-white/20">{{ $computer->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-black divide-y divide-gray-200">
                @php
                    $allParams = collect();

                    foreach ($computers as $computer) {
                        foreach ($computer->components as $component) {
                            foreach ($component->parameters as $paramValue) {
                                $allParams->push($paramValue->parameter->name);
                            }
                        }
                    }

                    $uniqueParams = $allParams->unique()->sort()->values();
                @endphp

                @foreach ($uniqueParams as $paramName)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 hover:bg-white/10">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white/90 border-b border-gray-200 dark:border-white/20">{{ $paramName }}</td>

                        @php
                            $values = [];

                            foreach ($computers as $computer) {
                                $found = null;
                                foreach ($computer->components as $component) {
                                    foreach ($component->parameters as $paramValue) {
                                        if ($paramValue->parameter->name === $paramName) {
                                            $found = $paramValue->value;
                                            break 2;
                                        }
                                    }
                                }
                                $values[] = $found;
                            }

                            // Проверка на числовые значения
                            $isNumeric = is_numeric($values[0]) && is_numeric($values[1]);

                            $highlight = [];
                            if ($isNumeric) {
                                $highlight = [
                                    $values[0] > $values[1] ? 'green' : ($values[0] < $values[1] ? 'red' : 'neutral'),
                                    $values[1] > $values[0] ? 'green' : ($values[1] < $values[0] ? 'red' : 'neutral'),
                                ];
                            } else {
                                $highlight = ['neutral', 'neutral'];
                            }
                        @endphp

                        @foreach ($values as $index => $val)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center border-b border-gray-200 dark:border-white/20
                                @if ($highlight[$index] === 'green') text-green-600 font-bold bg-green-500/10
                                @elseif($highlight[$index] === 'red') text-red-600 font-bold bg-red-500/10
                                @else text-gray-500 dark:text-white/60 @endif
                            ">
                                {{ $val ?? '—' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
