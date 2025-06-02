@extends('layouts.admin')

@section('content')

    <div>
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
                    <label class="block">Видео файл</label>
                    <x-forms.text-input
                        name="video"
                        type="file"
                        placeholder="видео файл"
{{--                        required="true"--}}
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
                    <label class="block">Стартовый кадр</label>
                    <x-forms.text-input
                        name="photo"
                        type="file"
                        placeholder="стартовый кадр"
{{--                        required="true"--}}
                        value="{{ old('photo') }}"
                        :isError="$errors->has('photo')"
                    />
                    @error('photo')
                    <x-forms.error>
                        {{ $message }}
                    </x-forms.error>
                    @enderror
                </div>

                <div id="upload-files-component" data-label="label 123" data-downloads='@json([])' data-multiply="false"></div>

                <div>
                    <x-forms.success-button>
                        Сохранить
                    </x-forms.success-button>
                </div>

            </div>
        </form>
    </div>

@endsection
