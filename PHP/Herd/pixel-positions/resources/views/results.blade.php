<x-layout>
    <x-page-heading>Results</x-page-heading>
    <div class="flex flex-col items-center">
        @if ($jobs->count() > 5)
            <a href="/">
                <x-forms.button>
                    << Back </x-forms.button>
            </a>
        @endif
        <div class="mt-6 mb-6 space-y-6">
            @if ($jobs->count() > 0)
                <h1 class="font-bold text-center ">Found {{ $jobs->count() }} Matches</h1>

                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            @else
                <h1 class="font-bold text-center ">Nothing matches your search.</h1>
            @endif

        </div>
        <a href="/">
            <x-forms.button>
                << Back </x-forms.button>
        </a>
    </div>
</x-layout>
