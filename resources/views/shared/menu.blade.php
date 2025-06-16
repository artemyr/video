<nav id="main-menu" class="mt-4 mb-4">
    <div class="grid justify-center">
        <div class="hidden w-[30px] h-[20px] relative" id="menu-burger">
            <div class="h-[2px] w-[30px] rounded-2xl absolute left-0 top-0 bg-black"></div>
            <div class="h-[2px] w-[30px] rounded-2xl absolute left-0 top-[9px] bg-black"></div>
            <div class="h-[2px] w-[30px] rounded-2xl absolute left-0 bottom-0 bg-black"></div>
        </div>
    </div>
    <ul class="grid grid-flow-row md:grid-flow-col justify-center text-[12px] uppercase transition-[height] duration-1000 overflow-hidden custom">
        @foreach($menu as $item)
            <li class="mx-[20px] mt-4 sm:mt-0 py-[8px] cursor-pointer underline @if($item->isActive()) font-bold @endif custom">
                <a href="{{ $item->link() }}">{{ $item->label() }}</a>
            </li>
        @endforeach
        @if(auth()->id() > 0)
            <form action="{{ route('logOut') }}" method="post">
                @csrf
                @method('DELETE')
                <li class="mx-[20px] mt-4 sm:mt-0 py-[8px] cursor-pointer underline custom">
                    <button type="submit">Выйти</button>
                </li>
            </form>
        @endif
    </ul>
</nav>
