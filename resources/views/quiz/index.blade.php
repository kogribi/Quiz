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
        @can('admin')
        <button type="button" onclick="deleteTopic()" class="bg-red-600 text-white px-5 py-2 rounded-md hover:bg-red-700 transition">
            Delete
        </button>
        <button type="button" onclick="editTopic()" class="bg-yellow-600 text-white px-5 py-2 rounded-md hover:bg-yellow-700 transition">
            Edit
        </button>
        @endcan
    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    function deleteTopic() {
    let topic = document.getElementById('topics').value;
    let topicName = document.getElementById('topics').options[document.getElementById('topics').selectedIndex].text;

    if (confirm(`Are you sure you want to delete "${topicName}"?`)) {
        fetch(`/quiz/${topic}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                window.location.reload();
            } else {
                alert('Something went wrong. Ensure the route exists.');
            }
        });
    }
}
function editTopic() {
    let select = document.getElementById('topics');
    let topic = select.value;
    let oldName = select.options[select.selectedIndex].text;

    let newName = prompt("Enter new name for the topic:", oldName);

    if (newName && newName !== oldName) {
        fetch(`/quiz/${topic}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ topic: newName })
        })
        .then(response => {
            if (response.ok) window.location.reload();
        });
    }
}
</script>
</x-app-layout>