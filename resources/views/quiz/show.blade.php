<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $topic->topic }}
        </h2>
    </x-slot>

    <div class="w-full bg-gray-200 h-4 rounded mb-4">
    <div 
        class="bg-blue-500 h-4 rounded"
        style="width: {{ ($questions->currentPage() / $questions->lastPage()) * 100 }}%">
    </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>
                        Question {{ $questions->currentPage() }} of {{ $questions->lastPage() }}
                    </p>
                    @foreach ($questions as $question)
                    <form method="POST" action="{{ route('quiz.answer', $topic->id) }}">
                        @csrf

                        <h3 class="mt-2">{{ $question->question }}</h3>

                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <input type="hidden" name="page" value="{{ $questions->currentPage() }}">

                        @foreach ($question->answers->shuffle() as $answer)
                            <div class="mt-2">
                            <label>
                                <input type="radio" name="answer_id" value="{{ $answer->id }}" required>
                                {{ $answer->answer }}
                            </label>
                            </div>  
                            <br>
                        @endforeach

                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
                            {{ $questions->hasMorePages() ? 'Next' : 'Finish' }}
                        </button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>