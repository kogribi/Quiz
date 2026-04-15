<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $topic->topic }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($topic->questions as $question)
                        <h3>{{ $question->question }}</h3>
                        @foreach ($question->answers as $answer)
                            <label>
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}">
                                {{ $answer->answer }}
                            </label>
                            <br>
                        @endforeach
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>