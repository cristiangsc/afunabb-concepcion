@props(['sort','direction','campo'])
@if($sort == $campo)
    @if($direction == 'asc')
        <i class="fas fa-sort-alpha-up float-right mt-1"></i>
    @else
        <i class="fas fa-sort-alpha-down float-right mt-1"></i>
    @endif
@else
    <i class="fas fa-sort float-right mt-1"></i>
@endif
