@props([
    'item' => null,
    'type' => 'simple',
    'class' => '',
    'resolution' => '500x500'
])

@if($type === 'external')

    <div class="lightgalery {{ $class }}">
        <a
            data-lg-size="{{ $item->size }}"
            data-src="{{ $item->getExternalVideoLinkForGallery() }}"
            data-poster="{{ $item->makeThumbnail($resolution) }}"
            data-sub-html="<h4>{{ $item->title }}</h4>"
        >

            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-50 hover:opacity-100 transition-opacity">
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="1.5"/>
                    <path d="M15.4137 10.941C16.1954 11.4026 16.1954 12.5974 15.4137 13.059L10.6935 15.8458C9.93371 16.2944 9 15.7105 9 14.7868L9 9.21316C9 8.28947 9.93371 7.70561 10.6935 8.15419L15.4137 10.941Z" stroke="#fff" stroke-width="1.5"/>
                </svg>
            </div>

            <img
                class="img-responsive"
                src="{{ $item->makeThumbnail($resolution) }}"
                alt="{{ $item->title }}"
            />
        </a>
    </div>

@elseif($type === 'internal')

    <div class="lightgalery {{ $class }}">
        <a
            data-lg-size="{{ $item->size }}"
            data-video='{"source": [{"src":"{{ $item->video() }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
            data-poster="{{ $item->makeThumbnail($resolution) }}"
            data-sub-html="<h4>{{ $item->title }}</h4>"
            class="relative hover:cursor-pointer"
        >

            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-50 hover:opacity-100 transition-opacity">
                <svg width="100px" height="100px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="1.5"/>
                    <path d="M15.4137 10.941C16.1954 11.4026 16.1954 12.5974 15.4137 13.059L10.6935 15.8458C9.93371 16.2944 9 15.7105 9 14.7868L9 9.21316C9 8.28947 9.93371 7.70561 10.6935 8.15419L15.4137 10.941Z" stroke="#fff" stroke-width="1.5"/>
                </svg>
            </div>

            <img
                class="img-responsive"
                src="{{ $item->makeThumbnail($resolution) }}"
                alt="{{ $item->title }}"
            />
        </a>
    </div>

@else

    <div class="{{ $class }}">
        <img src="{{ $item->makeThumbnail($resolution) }}" alt="{{ $item->title }}"/>
    </div>

@endif
