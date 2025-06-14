<div>
    <div class="col-span-6 sm:col-span-3">
        <label for="{{ $name }}" class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
        <input type="{{$type}}" name="{{ $name }}"
               class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg uppercase focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
               wire:model="{{ $name }}"
               id="{{$name}}"
               disabled
        >
    </div>
</div>
