<nav>
    <ul class="grid grid-flow-row md:grid-flow-col justify-center text-[12px] uppercase">
        @foreach($menu as $item)
            <li class="mx-[20px] py-[8px] cursor-pointer underline @if($item->isActive()) font-bold @endif">
                <a href="{{ $item->link() }}">{{ $item->label() }}</a>
            </li>
        @endforeach
    </ul>
</nav>
