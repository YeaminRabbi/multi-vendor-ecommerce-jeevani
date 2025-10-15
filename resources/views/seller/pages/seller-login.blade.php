<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="login">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Login
        </x-filament::button>
    </x-filament-panels::form>
</x-filament-panels::page.simple>
