<x-layout>
    <x-main>
        @vite('resources/css/app.css')
        <div class="flex items-center justify-center h-screen bg-gray-300" id="register">
            <div class="bg-white p-8 rounded-lg shadow-lg w-1/2 mt-20">
                <h1 class="text-2xl font-semibold mb-4">Support & HelpDesk</h1>
                {{-- Form Here --}}
                @livewire('ticket')
            </div>
        </div>
    </x-main>
</x-layout>
