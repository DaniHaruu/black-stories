<x-app-layout>
    <div class="min-h-screen bg-black px-6 py-10 text-white">
        <div class="mx-auto max-w-4xl">

            <h1 class="mb-8 text-3xl font-bold">
                Contact informatie
            </h1>

            <p>Naam: {{ $name }}</p>
            <p>E-mail: {{ $email }}</p>
            <p>{{ $message }}</p>

        </div>
    </div>
</x-app-layout>
