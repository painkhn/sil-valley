@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Сравнение компьютеров</h1>

        <div class="grid grid-cols-3 gap-4">
            <div></div>
            @foreach ($computers as $computer)
                <div class="text-center font-semibold text-xl">{{ $computer->name }}</div>
            @endforeach
        </div>

        <table class="table-auto w-full mt-6 border">
            <thead>
                <tr>
                    <th class="p-2 border">Характеристика</th>
                    @foreach ($computers as $computer)
                        <th class="p-2 border text-center">{{ $computer->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
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
                    <tr>
                        <td class="p-2 border font-medium">{{ $paramName }}</td>

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
                            <td
                                class="p-2 border text-center
                                @if ($highlight[$index] === 'green') text-green-600 font-bold
                                @elseif($highlight[$index] === 'red') text-red-600 font-bold @endif
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
