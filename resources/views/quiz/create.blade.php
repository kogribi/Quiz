<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Quizes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6 max-w-lg mx-auto">

                    {{-- Create Topic --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Create a Topic</h2>
                        <form method="POST" action="/quiz">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                            <input
                                name="topic"
                                value="{{ old('topic') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            @error('topic')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="mt-3 bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Create Topic
                            </button>
                        </form>
                    </div>

                    {{-- Create Question --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Create a Question</h2>
                        <form method="POST" action="/question" class="space-y-4">
                            @csrf

                            {{-- Topic --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                                <select
                                    name="topic_id"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white"
                                >
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->topic }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Question --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                                <input
                                    name="question"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>

                            {{-- Answers --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Answers</label>
                                <div id="answers-list" class="space-y-2">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="flex items-center gap-3 answer-row">
                                            <input
                                                type="text"
                                                name="answers[]"
                                                placeholder="Answer {{ $i + 1 }}"
                                                required
                                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            />
                                            <label class="flex items-center gap-1.5 text-sm text-gray-600 whitespace-nowrap cursor-pointer">
                                                <input type="radio" name="correct_answer" value="{{ $i }}" class="accent-blue-600" />
                                                Correct
                                            </label>
                                            @if ($i >= 2)
                                                <button
                                                    type="button"
                                                    onclick="removeAnswer(this)"
                                                    class="text-gray-400 hover:text-red-500 transition text-lg leading-none"
                                                    title="Remove"
                                                >&times;</button>
                                            @else
                                                <span class="w-5"></span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>

                                <button
                                    type="button"
                                    id="add-answer-btn"
                                    class="mt-3 flex items-center gap-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium transition"
                                >
                                    <span class="text-lg leading-none">+</span> Add Answer
                                </button>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Create Question
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let answerCount = 4;

        document.getElementById('add-answer-btn').addEventListener('click', function () {
            const list = document.getElementById('answers-list');
            const index = answerCount;

            const row = document.createElement('div');
            row.className = 'flex items-center gap-3 answer-row';
            row.innerHTML = `
                <input
                    type="text"
                    name="answers[]"
                    placeholder="Answer ${index + 1}"
                    required
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <label class="flex items-center gap-1.5 text-sm text-gray-600 whitespace-nowrap cursor-pointer">
                    <input type="radio" name="correct_answer" value="${index}" class="accent-blue-600" />
                    Correct
                </label>
                <button
                    type="button"
                    onclick="removeAnswer(this)"
                    class="text-gray-400 hover:text-red-500 transition text-lg leading-none"
                    title="Remove"
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