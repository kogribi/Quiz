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
<form method="GET" onsubmit="event.preventDefault(); 
    let topic = document.getElementById('topics').value;
    window.location.href = '/quiz/' + topic;">
    <label for="topics">Choose a topic:</label>
    
    <select name="topic" id="topics">
        @foreach ($topics as $topic)
            <option value="{{ $topic->id }}">{{ $topic->topic }}</option>
        @endforeach
    </select>
    
    <br>
    <button type="submit">Start</button>
</form>
</x-app-layout>