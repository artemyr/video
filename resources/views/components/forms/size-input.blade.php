@props([
    'type' => 'text',
    'value' => '',
    'height' => 0,
    'width' => 0,
    'isError' => false,
    'label' => 'Размер',
    'name' => 'size'
])

<label class="block">{{ $label }}</label>

<div x-data='@json([
        'height' => $height,
        'width' => $width,
    ])' {{ $attributes
    ->class([
        'border-red' => $isError,
        'text-black'
    ]) }}>
    <span class="text-white" x-text="(width && height) ? ('Ширина: '+width+' Высота: '+height) : ''"></span>
    <input class="border block rounded-md p-2 mb-2" type="number" x-model="width" placeholder="Ширина" name="x_size">
    <input class="border block rounded-md p-2 mb-2" type="number" x-model="height" placeholder="Высота" name="y_size">
    <input type="hidden" name="{{ $name }}" :value="(width && height) ? (width+'-'+height) : ''">
</div>
