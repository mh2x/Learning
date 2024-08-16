<h2>
    {{ $job->title }}
</h2>
<p>
    Congrats! You Job is available on our website!
</p>
<p>
    <a href='{{ url("/jobs/$job->id") }}'>View Your Job Listing</a>
</p>
