@if (count($breadcrumbs))

    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
        		@if (isset($breadcrumb->icon))
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{!! $breadcrumb->icon !!}</a></li>
        		@else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @endif
            @else
        		@if (isset($breadcrumb->icon))
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{!! $breadcrumb->icon !!}</a></li>
        		@else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @endif
            @endif

        @endforeach
    </ol>

@endif