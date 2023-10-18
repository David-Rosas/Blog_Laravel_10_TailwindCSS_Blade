@props(['currentCategory'])
<div class="relative lg:inline-flex bg-gray-100 rounded-xl">
    <div x-data="{ show: false }">
        {{-- Trigger--}}
        <button @click="show = !show" @click.away="show = false"
            class="py-2 pl-3 pr-9 text-sm font-semibold lg:w-32 w-full text-left flex lg:inline-flex">
            {{$currentCategory}}
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"></x-icon>
        </button>
        {{-- Links--}}
        <div x-show="show" class="py-2 absolute bg-gray-100 w-full rounded-xl text-left z-50 overflow-auto max-h-52" style="display: none">
            {{ $slot }}
        </div>
    </div>
