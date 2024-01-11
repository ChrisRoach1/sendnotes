<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
    ];
    }

    public function  delete($noteId){

        $note = Auth::user()->notes()->where('id', $noteId)->first();

        if($note){
            $this->authorize('delete',$note);
            $note->delete();
        }
    }
};

?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">no notes yet</p>
                <p class="text-sm">Let's create your first note to send.</p>
                <x-button primary icon-right="plus" class="mt-6"  href="{{ route('notes.create') }}" wire:navigate>Create Note</x-button>
            </div>
        @else
            <x-button primary icon-right="plus" class="mb-6"  href="{{ route('notes.create') }}" wire:navigate>Create Note</x-button>

            <div class="grid grid-cols-2 gap-4 mt-12">
                @foreach ($notes as $note)
                    <x-card wire:key='{{$note->id}}'>
                        <div class="flex justify-between">
                            <a href="{{route('notes.edit', $note)}}" wire:navigate class="text-x1 font-bold hover:underline hover:text-blue-500">
                                {{$note->title}}
                            </a>
                            <div class="text-sx text-gray-500">{{\Carbon\Carbon::parse($note->send_date)->format('M-d-Y')}}</div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">Recipient: <span class="font-semibold">{{$note->recipient}}</span></p>
                            <div>
                                <x-button.circle icon="eye"></x-button.circle>
                                <x-button.circle icon="trash" wire:click="delete('{{$note->id}}')"></x-button.circle>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif

    </div>

</div>
