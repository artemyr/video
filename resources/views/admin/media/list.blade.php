<div class="grid grid-flow-row gap-4">
    @foreach($videos as $video)
        <div class="bg-admin-light p-4 rounded-md">
            <div class="grid grid-flow-col justify-between">
                <div>
                    <div>id: {{ $video->id }}</div>
                    <div>title: {{ $video->title }}</div>
                    <div>type: {{ $video->mime }}</div>
                    <div>size: {{ $video->humanSize() }}</div>
                    <div>{{ $video->created_at }}</div>
                    <div>
                        <a href="{{ $video->url() }}" target="_blank">Посмотреть</a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('admin.download.destroy', [$video->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-forms.danger-button>
                            Удалить
                        </x-forms.danger-button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{ $videos->links() }}
