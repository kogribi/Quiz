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
                    <div class="bg-white border border-gray-200 rounded-lg p-6 max-w-lg">
                        <h1 class="text-lg font-semibold text-gray-900 mb-4">Create a topic</h1>
                        <form method="POST" action="/quiz">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                            <input name="topic" value="{{ old('topic') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            @error('topic')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="mt-3 bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-blue-700">
                                Create Topic
                            </button>
                        </form>
                    </div>

                    {{-- Create Question --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-6 max-w-lg">
                        <h1 class="text-lg font-semibold text-gray-900 mb-4">Create a question</h1>
                        <form method="POST" action="/question">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                            <select name="topic_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-white mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->topic }}</option>
                                @endforeach
                            </select>

                            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                            <input name="question" value="{{ old('question') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                            @error('question')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="mt-3 bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-blue-700">
                                Create Question
                            </button>
                        </form>
                    </div>

                    {{-- Create Answer --}}
                    <div class="bg-white border border-gray-200 rounded-lg p-6 max-w-lg">
                        <h1 class="text-lg font-semibold text-gray-900 mb-4">Create an answer</h1>
                        <form method="POST" action="/answer">
                            @csrf
                            <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                            <select name="question_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm bg-white mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach ($topics as $topic)
                                    <optgroup label="{{ $topic->topic }}">
                                        @foreach ($topic->questions as $question)
                                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>

                            <label class="block text-sm font-medium text-gray-700 mb-1">Answer</label>
                            <input name="answer" value="{{ old('answer') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-blue-500" />

                                <input type="hidden" name="is_correct" value="0">

                            <label class="flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
                                <input type="checkbox" name="is_correct" value="1" class="w-4 h-4 accent-blue-600" />
                                Correct answer
                            </label>

                            <button type="submit" class="mt-3 bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-md hover:bg-blue-700">
                                Create Answer
                            </button>
                        </form>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>