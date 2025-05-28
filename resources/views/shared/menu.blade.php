<nav id="main-menu">
    <ul class="grid grid-flow-row md:grid-flow-col justify-center text-[12px] uppercase">
        @foreach($menu as $item)
            <li class="mx-[20px] py-[8px] cursor-pointer underline @if($item->isActive()) font-bold @endif">
                <a href="{{ $item->link() }}">{{ $item->label() }}</a>
            </li>
        @endforeach
    </ul>
    <div class="hidden" id="menu-burger">
        <div>-</div>
        <div>-</div>
        <div>-</div>
    </div>
</nav>
