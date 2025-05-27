@extends('layouts.admin')

@section('content')

    <div class="container">
        <form action="{{ route('admin.main.slider.handle') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-flow-row gap-4">
                <div>
                    <label class="block">Заголовок</label>
                    <x-forms.text-input
                        name="title"
                        type="text"
                        placeholder="Заголовок"
                        required="true"
                        value="{{ old('title') }}"
                        :isError="$errors->has('title')"
                    />
                    @error('title')
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror
                </div>

                <div>
                    <label class="block">видео файл</label>
                    <x-forms.text-input
                        name="video"
                        type="file"
                        placeholder="видео файл"
                        required="true"
                        value="{{ old('video') }}"
                        :isError="$errors->has('video')"
                    />
                    @error('video')
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror
                </div>

                <div>
                    <label class="block">стартовый кадр</label>
                    <x-forms.text-input
                        name="photo"
                        type="file"
                        placeholder="стартовый кадр"
                        required="true"
                        value="{{ old('photo') }}"
                        :isError="$errors->has('photo')"
                    />
                    @error('photo')
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror
                </div>

                <x-forms.primary-button>
                    Сохранить
                </x-forms.primary-button>

            </div>
        </form>
    </div>

@endsection
