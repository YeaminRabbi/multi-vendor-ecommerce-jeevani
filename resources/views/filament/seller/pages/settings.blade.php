<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <x-filament::button type="submit" icon="heroicon-o-check" class="mt-3">
            Save Changes
        </x-filament::button>
    </form>
</x-filament-panels::page>
