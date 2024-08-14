<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>
    <ul>
        @foreach ($jobs as $job )
        <a class="text-blue-500 hover:underline" href="/jobs/{{$job['id']}}">
            <li>
                <strong>{{$job['title']}} </strong> : Makes <strong>{{$job['salary']}}</strong> per year.
            </li>
        </a>
        @endforeach
    </ul>
</x-layout>