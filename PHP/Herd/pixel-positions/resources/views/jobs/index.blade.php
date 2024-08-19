<x-layout>
    <!--
    The <section> tag in HTML5 is used to define a standalone section within
         a document. This could be a chapter, a thematic grouping of content,
         or any part of a document that is grouped in a meaningful way.
         Typically, a <section> should be accompanied by a heading to
            outline the content it encapsulates.
    -->
    <div class="space-y-10">
        <section class="text-center">
            <h1 class="font-bold text-4xl">Let's Find Your Next Job</h1>
            <x-forms.form method="POST" action="/search" class="mt-6">
                <x-forms.input type="text" name="q" :label="false" placeholder="Web developer..." />
            </x-forms.form>
        </section>
        <section class="pt-6">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach ($jobs as $job)
                    @if ($job->featured)
                        <x-job-card :$job />
                    @endif
                @endforeach

            </div>
        </section>
        <section>
            <x-section-heading>Tags</x-section-heading>
            <div class="mt-6 space-x-1">
                @foreach ($tags as $tag)
                    <!-- <x-tag :tag="$tag"/> -->
                    <x-tag :$tag />
                @endforeach
            </div>

        </section>
        <section>
            <x-section-heading>Recent Jobs</x-section-heading>
            <div class="mt-6 space-y-6">
                @foreach ($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        </section>
    </div>
</x-layout>
