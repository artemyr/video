@extends('layouts.app')

@section('content')
    <div class="container">

        @if(!empty($formMessage))
            <x-forms.error>
                {{ $formMessage }}
            </x-forms.error>
        @endif

        @if($showForm)

            <form action="{{ route('review.send') }}" method="post" enctype="multipart/form-data" id="review-form">
                @csrf

                @error('g-recaptcha-response')
                {{ $message }}
                @enderror

                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900">Оставить отзыв</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm/6 font-medium text-gray-900">Название компании</label>
                                <div class="mt-2">
                                    <input id="title" type="text" name="title"
                                           class="@if($errors->has('title')) outline-red shadow-[0px_0px_6px_0px_#ff0000] @else outline-gray-300 @endif block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                                @error('title')
                                <x-forms.error>
                                    Заполните название компании
                                </x-forms.error>
                                @enderror
                            </div>

                            <div class="col-span-full">
                                <label for="description" class="block text-sm/6 font-medium text-gray-900">Отзыв</label>
                                <div class="mt-2">
                                    <textarea id="description" name="description" rows="3"
                                              class="@if($errors->has('description')) outline-red shadow-[0px_0px_6px_0px_#ff0000] @else outline-gray-300 @endif block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                                </div>
                                <p class="mt-3 text-sm/6 text-gray-600">Напишите пару слов</p>
                            </div>
                            @error('description')
                            <x-forms.error>
                                Напишите отзыв
                            </x-forms.error>
                            @enderror
                        </div>

                        <div class="col-span-full mt-10">
                            <label for="file-upload" class="block text-sm/6 font-medium text-gray-900">Фото</label>
                            <div id="dropZone" class="@if($errors->has('image')) outline-red shadow-[0px_0px_6px_0px_#ff0000] @else border border-dashed border-gray-900/25 @endif mt-2 grid grid-flow-row gap-8 justify-center rounded-lg px-6 py-10">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                         class="mx-auto size-12 text-gray-300">
                                        <path
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" fill-rule="evenodd"/>
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" type="file" name="image" class="sr-only"/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>

                                    </div>
                                    <p class="text-xs/5 text-gray-600">{{ $fileInputLabel }}</p>
                                </div>
                                <ul class="" id="fileList"></ul>
                            </div>

                            @error('image')
                                <x-forms.error>
                                    Файл не соответствует разрешенным типам или слмишком большой
                                </x-forms.error>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button class="g-recaptcha rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        data-sitekey="{{ config('captcha.key') }}"
                        data-callback='onSubmit'
                        data-action='submit'
                        type="submit">
                        Submit
                    </button>
                </div>

                @if ($showCaptcha)
                    @push('scripts')
                        <script>
                            function onSubmit(token) {
                                document.getElementById("review-form").submit();
                            }
                        </script>
                    @endpush
                @endif
                @push('scripts')
                    <script>
                        const dropZone = document.getElementById('dropZone');
                        const fileInput = document.getElementById('file-upload');
                        const fileList = document.getElementById('fileList');
                        const className = 'shadow-[0px_0px_6px_2px_#706bff]'

                        // Клик по зоне открывает файловый диалог
                        dropZone.addEventListener('click', () => fileInput.click());

                        // Подсветка при перетаскивании
                        dropZone.addEventListener('dragover', (e) => {
                            e.preventDefault();
                            dropZone.classList.add(className);
                        });

                        dropZone.addEventListener('dragleave', () => {
                            dropZone.classList.remove(className);
                        });

                        // Обработка сброса файлов
                        dropZone.addEventListener('drop', (e) => {
                            e.preventDefault();
                            dropZone.classList.remove(className);

                            let files = e.dataTransfer.files;
                            fileInput.files = files

                            handleFiles(files);
                        });

                        // Обработка выбора файлов через input
                        fileInput.addEventListener('change', () => {
                            handleFiles(fileInput.files);
                        });

                        // Функция отображения файлов
                        function handleFiles(files) {
                            fileList.innerHTML = ''; // очищаем список
                            Array.from(files).forEach(file => {
                                const li = document.createElement('li');
                                li.textContent = `${file.name} (${Math.round(file.size / 1024)} KB)`;
                                fileList.appendChild(li);
                            });
                        }
                    </script>
                @endpush
            </form>
        @endif
    </div>
@endsection
