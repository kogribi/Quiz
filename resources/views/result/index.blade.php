<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex gap-20">
                    @foreach ($results as $result)
                    <div>
                    <h1 class="font-semibold">{{$result->topic->topic}}:</h1>
                    <p value="{{ $result->id }}">Score: {{ $result->score}} / {{$result->total }}</p>
                    @if($result->score == $result->total)
                    <p class="text-red-500">Perfect!</p>
                    @elseif($result->score >= $result->total/2)
                    <p class="text-purple-500">Halfway there!</p>
                    @else
                    <p class="text-purple-500">Nice try!</p>
                    @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>