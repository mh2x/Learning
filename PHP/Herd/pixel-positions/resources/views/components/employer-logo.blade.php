@props(['employer', 'width' => 90])

@if (str_starts_with($employer->logo, 'logos'))
    <img src="{{ asset($employer->logo) }}" alt="" class="rounded-xl" width="{{ $width }}">
@else
    <img src="http://picsum.photos/seed/{{ rand(0, 100000) }}/{{ $width }}" alt=""
        class="rounded-xl border border-red-500">
@endif
