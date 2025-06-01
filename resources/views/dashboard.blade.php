<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }} {{auth()->user()->name}} 
                </div>
                @if (auth()->user()->user_type === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @elseif (auth()->user()->user_type === 'vendor')
                    <a href="{{ route('vendor.dashboard') }}">Vendor Dashboard</a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
