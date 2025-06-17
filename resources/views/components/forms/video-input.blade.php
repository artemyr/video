@props([
    'type' => 'text',
    'value' => '',
    'height' => 0,
    'width' => 0,
    'link' => '',
    'videoName' => 'video',
    'sizeName' => 'size',
    'linkName' => 'link',
    'linkLabel' => 'Ссылка на видео',
    'linkValue' => '',
])

@error($videoName)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror

<x-forms.file-input
    link="{{ $link }}"
    label="Видео"
    name="{{ $videoName }}"
    :isError="$errors->has($videoName)"
></x-forms.file-input>

@error($linkName)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror

<x-forms.text-input
    name="{{ $linkName }}"
    value="{{ $linkValue }}"
    label="{{ $linkLabel }}"
    :isError="$errors->has($linkName)"
>
</x-forms.text-input>

@error($sizeName)
<x-forms.error>
    {{ $message }}
</x-forms.error>
@enderror

<x-forms.size-input
    height="{{ $height }}"
    width="{{ $width }}"
    name="{{ $sizeName }}"
    :isError="$errors->has($sizeName)"
>
</x-forms.size-input>
