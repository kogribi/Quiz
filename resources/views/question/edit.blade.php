<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 max-w-lg mx-auto">
                    {{-- Edit Question --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
    <h2 class="text-lg font-semibold text-gray-900 mb-4">Edit Question</h2>
    
    <form method="POST" action="{{ route('question.update', $question->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        {{-- Topic --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
            <div class="w-full px-3 py-2 border border-gray-100 bg-gray-50 text-gray-500 rounded-md text-sm">
        {{ $question->topic->topic }}
    </div>
    <input type="hidden" name="topic_id" value="{{ $question->topic_id }}">
        </div>

        {{-- Question --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
            <input name="question" value="{{ $question->question }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm" />
        </div>

        {{-- Answers --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Answers</label>
            <div id="answers-list" class="space-y-2">
                @foreach ($question->answers as $i => $answer)
                    <div class="flex items-center gap-3 answer-row">
                        <input type="hidden" name="answers[{{ $i }}][id]" value="{{ $answer->id }}">
                        
                        <input type="text" name="answers[{{ $i }}][text]" value="{{ $answer->answer }}" required
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm" />
                        
                        <label class="flex items-center gap-1.5 text-sm text-gray-600 whitespace-nowrap cursor-pointer">
                            <input type="checkbox" name="answers[{{ $i }}][correct]" value="1" 
                                {{ $answer->is_correct ? 'checked' : '' }} class="accent-blue-600" />
                            Correct
                        </label>

                        @if ($i >= 2)
                            <button type="button" onclick="removeAnswer(this)" class="text-gray-400 hover:text-red-500">&times;</button>
                        @else
                            <span class="w-5"></span>
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="button" id="add-answer-btn" class="mt-3 text-sm text-blue-600 font-medium">
                + Add Answer
            </button>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md">
            Update Question
        </button>
    </form>
</div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let answerCount = {{ $question->answers->count() }};
        document.getElementById('add-answer-btn').addEventListener('click', function () {
            const list = document.getElementById('answers-list');
            const index = document.querySelectorAll('.answer-row').length; 

            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 answer-row';
            row.innerHTML = `
                <input
                    type="text"
                    name="answers[${index}][text]" 
                    placeholder="Answer ${index + 1}"
                    required
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <label class="flex items-center gap-1.5 text-sm text-gray-600 whitespace-nowrap cursor-pointer">
                    <input type="checkbox" name="answers[${index}][correct]" value="1" class="accent-blue-600" />
                    Correct
                </label>
                <button
                    type="button"
                    onclick="removeAnswer(this)"
                    class="text-gray-400 hover:text-red-500 transition text-lg leading-none"
                >&times;</button>
            `;
            list.appendChild(row);
            answerCount++;
        });

        function removeAnswer(btn) {
            const rows = document.querySelectorAll('.answer-row');
            if (rows.length <= 2) return;
            btn.closest('.answer-row').remove();
        }
    </script>
</x-app-layout>