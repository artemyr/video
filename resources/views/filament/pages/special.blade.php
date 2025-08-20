<x-filament-panels::page>
    <div>
        @foreach($errors as $error)
            <p class="color-red">{{ $error }}</p>
        @endforeach

        <p>Тип кеширования: {{ $cacheType }}</p>

        <p class="mb-2 text-2xl">Unused Files detect ({{ $countUnusedFiles }}): {{ $date }} <button wire:click="reload">reload</button></p>
        <ul>
            @foreach($unusedFiles as $filePath)
                <li>{{ $filePath }}</li>
            @endforeach
        </ul>

        <p class="mb-2 text-2xl">Video size {{ $videoSize }} mb</p>

        <p class="mb-2 text-2xl">Resizes {{ $resizesCount }} <button wire:click="clearResizes">Clear resizes</button></p>
        <ul>
            @foreach($resizes as $resize)
                <li>{{ $resize }}</li>
            @endforeach
        </ul>
    </div>
</x-filament-panels::page>
