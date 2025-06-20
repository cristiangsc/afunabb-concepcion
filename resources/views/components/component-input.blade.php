<div>
    <div class="col-span-6 sm:col-span-3 {{$mask ? 'number' : ''}}">
        <label for="{{ $name }}"
               class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
        <input type="{{$type}}" name="{{ $name }}" accept="image/png, image/jpeg"
               class="text-md shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5"
               placeholder="{{ $placeholder }}"
               wire:model="{{ $name }}"
               id="{{$name}}"

        >
    </div>

    <x-input-error for="{{$name}}"/>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.addEventListener('input', (e) => {

                if (e.target['type'] === 'text') {
                    document.querySelectorAll(".number").forEach(el => el.addEventListener("keyup", numberFormat));
                }

                function numberFormat(e) {

                    let num = e.target['value'].replace(/\./g,'');
                    if(!isNaN(num)) {
                        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
                        num = num.split('').reverse().join('').replace(/^[\.]/, '');
                        e.target['value'] = num;
                    }else{ alert('Solo se permiten números');
                        e.target['value'] = e.target['value'].replace(/[^\d\.]*/g,'');
                    }
                    console.log(num)
                }
            })
        })
    </script>

</div>
