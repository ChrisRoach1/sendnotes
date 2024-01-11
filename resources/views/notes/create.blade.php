<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-5">
            <x-button secondary icon="arrow-left" href="{{route('notes.index')}}">All Notes</x-button>
            <livewire:notes.create-note/>
        </div>
    </div>
</x-app-layout>
