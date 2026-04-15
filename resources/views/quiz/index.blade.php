<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quizes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("This is where you can see and do quizes!") }}
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
    <form method="GET" onsubmit="event.preventDefault(); 
        let topic = document.getElementById('topics').value;
        window.location.href = '/quiz/' + topic;">
       <label for="topics" class="block mb-2 text-sm font-medium text-gray-700">
            Choose a topic:
        </label>

    <select name="topic" id="topics"
        class="w-fit px-8 py-2 border border-gray-300 rounded-md bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        @foreach ($topics as $topic)
            <option value="{{ $topic->id }}">
                {{ $topic->topic }}
            </option>
        @endforeach
    </select>

        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition">
            Start
        </button>
    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>