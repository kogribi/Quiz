<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($results as $result)

                    @php
                        $isPerfect = $result->score == $result->total;
                        $isHalfway = $result->score >= $result->total / 2;
                    @endphp

                    <div class="rounded-xl border p-5 flex flex-col gap-2 shadow-sm hover:shadow-md transition-shadow duration-200
                        {{ $isPerfect ? 'border-amber-200 bg-amber-50' : ($isHalfway ? 'border-purple-200 bg-purple-50' : 'border-pink-200 bg-pink-50') }}">

                        <h2 class="font-bold text-gray-800 text-base leading-snug">
                            {{ $result->topic->topic }}
                        </h2>

                        <p class="text-3xl font-extrabold
                            {{ $isPerfect ? 'text-amber-500' : ($isHalfway ? 'text-purple-500' : 'text-pink-400') }}">
                            {{ $result->score }}<span class="text-base font-medium text-gray-400">/{{ $result->total }}</span>
                        </p>

                        @if($isPerfect)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-700 w-fit">
                                ⭐ Perfect!
                            </span>
                        @elseif($isHalfway)
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-100 text-purple-700 w-fit">
                                💪 Halfway there!
                            </span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-pink-100 text-pink-600 w-fit">
                                🙌 Nice try!
                            </span>
                        @endif

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>