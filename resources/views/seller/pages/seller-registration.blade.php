<x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="register">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Register
        </x-filament::button>
        <a class="text-center text-primary-50" href="{{route('filament.seller.auth.login')}}">Already Have an Account? Login</a>
    </x-filament-panels::form>
</x-filament-panels::page.simple>
