@extends('layouts.app')

@section('content')
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

        <!-- Название компьютера -->
        <div>
            <label for="name">Название компьютера:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <!-- Описание компьютера -->
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <!-- Цена компьютера -->
        <div>
            <label for="price">Цена:</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}" required>
        </div>

        <!-- Фото компьютера -->
        <div>
            <label for="image">Фото:</label>
            <input type="file" name="image" id="image">
        </div>

        <!-- Компоненты -->
        <h3>Компоненты:</h3>

        <!-- Процессор -->
        <div>
            <h4>Процессор</h4>
            <label for="cpu_name">Название:</label>
            <input type="text" name="components[cpu][name]" id="cpu_name" value="{{ old('components.cpu.name') }}"
                required>

            <label for="cpu_cores">Ядра:</label>
            <input type="number" name="components[cpu][cores]" id="cpu_cores" value="{{ old('components.cpu.cores') }}"
                required>

            <label for="cpu_threads">Потоки:</label>
            <input type="number" name="components[cpu][threads]" id="cpu_threads"
                value="{{ old('components.cpu.threads') }}" required>

            <label for="cpu_base_clock">Базовая частота (GHz):</label>
            <input type="number" name="components[cpu][base_clock]" id="cpu_base_clock"
                value="{{ old('components.cpu.base_clock') }}" step="0.1">
        </div>

        <!-- Оперативная память -->
        <div>
            <h4>Оперативная память</h4>
            <label for="ram_name">Название:</label>
            <input type="text" name="components[ram][name]" id="ram_name" value="{{ old('components.ram.name') }}"
                required>

            <label for="ram_capacity">Объем (GB):</label>
            <input type="number" name="components[ram][capacity]" id="ram_capacity"
                value="{{ old('components.ram.capacity') }}" required>

            <label for="ram_speed">Частота (MHz):</label>
            <input type="number" name="components[ram][speed]" id="ram_speed" value="{{ old('components.ram.speed') }}"
                required>
        </div>

        <!-- Видеокарта -->
        <div>
            <h4>Видеокарта</h4>
            <label for="gpu_name">Название:</label>
            <input type="text" name="components[gpu][name]" id="gpu_name" value="{{ old('components.gpu.name') }}"
                required>

            <label for="gpu_memory">Объем памяти (GB):</label>
            <input type="number" name="components[gpu][memory]" id="gpu_memory" value="{{ old('components.gpu.memory') }}"
                required>

            <label for="gpu_clock">Частота (MHz):</label>
            <input type="number" name="components[gpu][clock]" id="gpu_clock" value="{{ old('components.gpu.clock') }}">
        </div>

        <!-- Жесткий диск -->
        <div>
            <h4>Жесткий диск (HDD/SSD)</h4>
            <label for="storage_name">Название:</label>
            <input type="text" name="components[storage][name]" id="storage_name"
                value="{{ old('components.storage.name') }}" required>

            <label for="storage_capacity">Объем (GB):</label>
            <input type="number" name="components[storage][capacity]" id="storage_capacity"
                value="{{ old('components.storage.capacity') }}" required>

            <label for="storage_type">Тип (HDD/SSD):</label>
            <select name="components[storage][type]" id="storage_type">
                <option value="HDD" {{ old('components.storage.type') == 'HDD' ? 'selected' : '' }}>HDD</option>
                <option value="SSD" {{ old('components.storage.type') == 'SSD' ? 'selected' : '' }}>SSD</option>
            </select>
        </div>

        <!-- Материнская плата -->
        <div>
            <h4>Материнская плата</h4>
            <label for="motherboard_name">Название:</label>
            <input type="text" name="components[motherboard][name]" id="motherboard_name"
                value="{{ old('components.motherboard.name') }}" required>

            <label for="motherboard_chipset">Чипсет:</label>
            <input type="text" name="components[motherboard][chipset]" id="motherboard_chipset"
                value="{{ old('components.motherboard.chipset') }}" required>

            <label for="motherboard_form_factor">Форм-фактор:</label>
            <input type="text" name="components[motherboard][form_factor]" id="motherboard_form_factor"
                value="{{ old('components.motherboard.form_factor') }}" required>
        </div>

        <!-- Блок питания -->
        <div>
            <h4>Блок питания</h4>
            <label for="psu_name">Название:</label>
            <input type="text" name="components[psu][name]" id="psu_name" value="{{ old('components.psu.name') }}"
                required>

            <label for="psu_wattage">Мощность (W):</label>
            <input type="number" name="components[psu][wattage]" id="psu_wattage"
                value="{{ old('components.psu.wattage') }}" required>

            <label for="psu_efficiency">Эффективность (%):</label>
            <input type="number" name="components[psu][efficiency]" id="psu_efficiency"
                value="{{ old('components.psu.efficiency') }}" required>
        </div>

        <!-- Корпус -->
        <div>
            <h4>Корпус</h4>
            <label for="case_name">Название:</label>
            <input type="text" name="components[case][name]" id="case_name"
                value="{{ old('components.case.name') }}" required>

            <label for="case_form_factor">Форм-фактор:</label>
            <input type="text" name="components[case][form_factor]" id="case_form_factor"
                value="{{ old('components.case.form_factor') }}" required>
        </div>

        <button type="submit">Сохранить</button>
    </form>
@endsection
