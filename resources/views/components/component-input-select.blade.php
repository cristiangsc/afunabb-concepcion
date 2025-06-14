<div>
    <div class="col-span-6 sm:col-span-3">
        <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
        <select  wire:model="{{ $name }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
            <option value="">Seleccione</option>
            @foreach($options as $key => $option)
                <option value="{{ $option->id }}">{{ $option->$campo }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error for="{{$name}}"/>
</div>
