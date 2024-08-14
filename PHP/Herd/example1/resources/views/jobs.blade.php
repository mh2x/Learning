<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    <div class="space-y-4">
        @foreach ($jobs as $job )
        <a class="block px-4 py-6 border border-gray-200 rounded-lg"
            href="/jobs/{{$job['id']}}">
            <strong>{{$job['title']}} </strong> : Makes <strong>{{$job['salary']}}</strong> per year.
        </a>
        @endforeach
    </div>
</x-layout>
