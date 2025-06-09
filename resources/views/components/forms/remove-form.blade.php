@props([
    'url' => ''
])

<form action="{{ $url }}" method="post">
    @csrf
    @method('DELETE')
    <x-forms.danger-button>
        {{ $slot }}
    </x-forms.danger-button>
</form>
