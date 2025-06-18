@extends('layouts.admin')

@section('content')
    <form class="space-y-3" action="{{ route('admin.main.slider.update', $item->id) }}"
          method="post" enctype="multipart/form-data">
        @csrf

        <x-forms.text-input
            :value="old('title', $item->title)"
            label="Название"
            name="title"
            :isError="$errors->has('title')"
        ></x-forms.text-input>

        <x-forms.text-input
            :value="old('sort', $item->sort)"
            label="Сортировка"
            name="sort"
            :isError="$errors->has('sort')"
        ></x-forms.text-input>

        <x-forms.checkbox-input
            :value="old('active', $item->active)"
            label="Активность"
            name="active"
            :isError="$errors->has('active')"
        ></x-forms.checkbox-input>

        <x-forms.file-input
            :image="$item->image()"
            label="Картинка"
            name="image"
            :isError="$errors->has('image')"
        ></x-forms.file-input>

        <x-forms.video-input
            :link="$item->video()"
            linkName="link"
            :linkValue="old('link', $item->video())"
            :height="old('x_size', $item->size->height())"
            :width="old('y_size', $item->size->width())"
        >
        </x-forms.video-input>

        <x-forms.success-button>
            Сохранить
        </x-forms.success-button>

    </form>
@endsection
