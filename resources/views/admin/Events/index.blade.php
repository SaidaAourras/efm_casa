<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Liste des événements
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        <div class="flex  mb-4">
            <div class="flex justify-end mb-4">
                <a href="{{ route('events.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Ajouter un événement
                </a>
            </div>
            <div class="flex S mb-4">
                <form method="GET">
                    <select name="user_id" onchange="this.form.submit()">
                        <option value="">-- Tous les utilisateurs --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $event)
                <x-card-event :event="$event"></x-card-event>
            @empty
                <p class="text-gray-600">Aucun événement disponible pour le moment.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
</x-app-layout>
