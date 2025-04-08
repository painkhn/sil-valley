@extends('layouts.app')

@section('content')
    <div class="px-10">
        <form action="{{ route('admin.computer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-3 gap-5">
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <!-- Название компьютера -->
                    <div class="space-y-2">
                        <label for="name">Название компьютера:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <!-- Описание компьютера -->
                    <div class="space-y-2">
                        <label for="description">Описание:</label>
                        <textarea class="transition-all w-full min-h-20 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" name="description" id="description">{{ old('description') }}</textarea>
                    </div>

                    <!-- Цена компьютера -->
                    <div class="space-y-2">
                        <label for="price">Цена:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="price" id="price" value="{{ old('price') }}" required>
                    </div>

                    <!-- Фото компьютера -->
                    <div class="space-y-2">
                        <label for="image">Фото:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="file" name="image" id="image">
                    </div>
                </div>

                <!-- Компоненты -->
                <!-- <h3>Компоненты:</h3> -->

                <!-- Процессор -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Процессор</h4>
                    <div class="space-y-2">
                        <label for="cpu_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[cpu][name]" id="cpu_name" value="{{ old('components.cpu.name') }}"
                            required>
                    </div>

                    <div class="space-y-2">
                        <label for="cpu_cores">Ядра:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[cpu][cores]" id="cpu_cores" value="{{ old('components.cpu.cores') }}"
                            required>
                    </div>

                    <div class="space-y-2">
                        <label for="cpu_threads">Потоки:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[cpu][threads]" id="cpu_threads"
                            value="{{ old('components.cpu.threads') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="cpu_base_clock">Базовая частота (GHz):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[cpu][base_clock]" id="cpu_base_clock"
                            value="{{ old('components.cpu.base_clock') }}" step="0.1">
                    </div>
                </div>

                <!-- Оперативная память -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Оперативная память</h4>
                    <div class="space-y-2">
                        <label for="ram_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[ram][name]" id="ram_name" value="{{ old('components.ram.name') }}"
                            required>
                    </div>

                    <div class="space-y-2">
                        <label for="ram_capacity">Объем (GB):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[ram][capacity]" id="ram_capacity"
                            value="{{ old('components.ram.capacity') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="ram_speed">Частота (MHz):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[ram][speed]" id="ram_speed" value="{{ old('components.ram.speed') }}"
                            required>
                    </div>
                </div>

                <!-- Видеокарта -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Видеокарта</h4>
                    <div class="space-y-2">
                        <label for="gpu_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[gpu][name]" id="gpu_name" value="{{ old('components.gpu.name') }}"
                            required>
                    </div>

                    <div class="space-y-2">
                        <label for="gpu_memory">Объем памяти (GB):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[gpu][memory]" id="gpu_memory" value="{{ old('components.gpu.memory') }}"
                            required>
                    </div class="space-y-2">

                    <div class="space-y-2">
                        <label for="gpu_clock">Частота (MHz):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[gpu][clock]" id="gpu_clock" value="{{ old('components.gpu.clock') }}">
                    </div>
                </div>

                <!-- Жесткий диск -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Жесткий диск (HDD/SSD)</h4>
                    <div class="space-y-2">
                        <label for="storage_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[storage][name]" id="storage_name"
                            value="{{ old('components.storage.name') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="storage_capacity">Объем (GB):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[storage][capacity]" id="storage_capacity"
                            value="{{ old('components.storage.capacity') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="storage_type">Тип (HDD/SSD):</label>
                        <select class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" name="components[storage][type]" id="storage_type">
                            <option class="bg-black" value="HDD" {{ old('components.storage.type') == 'HDD' ? 'selected' : '' }}>HDD</option>
                            <option class="bg-black" value="SSD" {{ old('components.storage.type') == 'SSD' ? 'selected' : '' }}>SSD</option>
                        </select>
                    </div>
                </div>

                <!-- Материнская плата -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Материнская плата</h4>
                    <div class="space-y-2">
                        <label for="motherboard_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[motherboard][name]" id="motherboard_name"
                            value="{{ old('components.motherboard.name') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="motherboard_chipset">Чипсет:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[motherboard][chipset]" id="motherboard_chipset"
                            value="{{ old('components.motherboard.chipset') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="motherboard_form_factor">Форм-фактор:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[motherboard][form_factor]" id="motherboard_form_factor"
                            value="{{ old('components.motherboard.form_factor') }}" required>
                    </div>
                </div>

                <!-- Блок питания -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Блок питания</h4>
                    <div class="space-y-2">
                        <label for="psu_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[psu][name]" id="psu_name" value="{{ old('components.psu.name') }}"
                            required>
                    </div>

                    <div class="space-y-2">
                        <label for="psu_wattage">Мощность (W):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[psu][wattage]" id="psu_wattage"
                            value="{{ old('components.psu.wattage') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="psu_efficiency">Эффективность (%):</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="number" name="components[psu][efficiency]" id="psu_efficiency"
                            value="{{ old('components.psu.efficiency') }}" required>
                    </div>
                </div>

                <!-- Корпус -->
                <div class="w-full p-5 border-2 border-dashed border-white/50 rounded-md space-y-4">
                    <h4 class="text-xl font-semibold mb-4">Корпус</h4>
                    <div class="space-y-2">
                        <label for="case_name">Название:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[case][name]" id="case_name"
                            value="{{ old('components.case.name') }}" required>
                    </div>

                    <div class="space-y-2">
                        <label for="case_form_factor">Форм-фактор:</label>
                        <input class="transition-all w-full py-2 bg-white/5 border-0 outline-none focus:ring-0 ring-0 focus:bg-white/10 rounded-xl px-4 pr-12" type="text" name="components[case][form_factor]" id="case_form_factor"
                            value="{{ old('components.case.form_factor') }}" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="mx-auto block mt-5 px-8 py-3 font-semibold bg-green-500 transition-all hover:dark:bg-green-400 rounded-xl dark:text-black">Сохранить</button>
        </form>
    </div>
@endsection
