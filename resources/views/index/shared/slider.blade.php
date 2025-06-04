@if(!empty($slider->video()))
    <div class="swiper-slide lightgalery">
        <a
                data-lg-size="{{ $slider->size }}"
                data-video='{"source": [{"src":"{{ $slider->video() }}", "type":"video/mp4"}], "attributes": {"preload": false, "playsinline": true, "controls": true}}'
                data-poster="{{ $slider->makeThumbnail('500x500') }}"
                data-sub-html="<h4>{{ $slider->title }}</h4>"
        >
            <img
                class="img-responsive"
                src="{{ $slider->makeThumbnail('500x500') }}"
                alt="{{ $slider->title }}"
            />
        </a>
    </div>
@else
    <div class="swiper-slide">
        <img src="{{ $slider->makeThumbnail('500x500') }}" alt="{{ $slider->title }}"/>
    </div>
@endif
