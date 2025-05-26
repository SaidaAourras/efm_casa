<div>
    <div class="bg-white shadow rounded p-4">
        <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->titre }}"
            class="w-full h-48 object-cover rounded mb-4">

        <h3 class="text-lg font-semibold">{{ $event->titre }}</h3>
        <p class="text-gray-600 text-sm">{{ $event->description }}</p>
        <p class="text-sm mt-2">📍 {{ $event->lieu }}</p>
        <p class="text-sm">📅 Du {{ $event->date_debut }} au {{ $event->date_fin }}</p>
    </div>
</div>
