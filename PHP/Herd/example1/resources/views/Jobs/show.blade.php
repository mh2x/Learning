<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $job['title'] }}</h2>
    <p>
        This job pays {{ $job['salary'] }}
    </p>
    {{--
    this is using Gate::define
    @can('edit-job', $job)
    --}}
    {{-- Using JobPolicy --}}
    @can('edit', $job)
        <p class="mt-6">
            <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
        </p>
    @endcan
</x-layout>
