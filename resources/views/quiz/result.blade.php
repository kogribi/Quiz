<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Result') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h1 class="text-2xl font-bold mb-2">{{ $topic }}</h1>
                    <h2 class="text-xl mb-6">Your Score: <span class="font-bold">{{ $score }} / {{ $total }}</span></h2>
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        <a href="/quiz/{{$topic_id}}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition">
                            Retake Quiz
                        </a>

                        <a href="{{ route('quiz') }}" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-200 transition">
                            Choose a different topic
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>