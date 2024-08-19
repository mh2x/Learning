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
            <h1 class="font-bold text-3xl">Let's Find Your Next Job</h1>
            <form method="POST" action="" class="mt-6">
                <input type="text" placeholder="Web developer..."
                    class="rounded-xl bg-white/5 border border-white/10 px-5 py-4 w-full max-w-xl">
            </form>
        </section>
        <section class="pt-6">
            <x-section-heading>Featured Jobs</x-section-heading>
            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach ($jobs as $job)
                    <x-job-card :$job />
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
