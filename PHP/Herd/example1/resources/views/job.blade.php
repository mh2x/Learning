<x-layout>
    <x-slot:heading>
        Job Info
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{$job['title']}}</h2>
    <p>
        This job pays {{$job['salary']}}
    </p>
</x-layout>