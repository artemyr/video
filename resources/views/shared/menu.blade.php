<nav id="main-menu">
    <div class="grid justify-center">
        <div class="hidden w-[15px] h-[15px] relative" id="menu-burger">
            <div class="h-[2px] w-[15px] rounded-2xl absolute left-0 top-0 bg-black"></div>
            <div class="h-[2px] w-[15px] rounded-2xl absolute left-0 top-[7px] bg-black"></div>
            <div class="h-[2px] w-[15px] rounded-2xl absolute left-0 bottom-0 bg-black"></div>
        </div>
    </div>
    <ul class="grid grid-flow-row md:grid-flow-col justify-center text-[12px] uppercase transition-[height] duration-1000 overflow-hidden">
        @foreach($menu as $item)
            <li class="mx-[20px] py-[8px] cursor-pointer underline @if($item->isActive()) font-bold @endif">
                <a href="{{ $item->link() }}">{{ $item->label() }}</a>
            </li>
        @endforeach
    </ul>
</nav>
