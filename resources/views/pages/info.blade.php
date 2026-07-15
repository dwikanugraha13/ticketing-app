<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-16">
        <a href="{{ route('home') }}" class="text-sm text-blue-900 hover:underline">&larr; Kembali ke Beranda</a>

        <h1 class="text-3xl font-black uppercase italic mt-4 mb-8">{{ $title }}</h1>

        <div class="space-y-4 text-gray-700 leading-relaxed">
            @foreach ($paragraphs as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>
</x-app-layout>
