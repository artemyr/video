@extends('layouts.app')

@section('content')
    <div class="container">

        @if(!empty($formMessage))
            <p>{{ $formMessage }}</p>
        @endif

        @if($showForm)

            <form>
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base/7 font-semibold text-gray-900">Оставить отзыв</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" type="email" name="email" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Фото</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                         class="mx-auto size-12 text-gray-300">
                                        <path
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" fill-rule="evenodd"/>
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label for="file-upload"
                                               class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" type="file" name="file-upload" class="sr-only"/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Отправить
                    </button>
                </div>
            </form>







            <form action="{{ route('review.send') }}" method="post" enctype="multipart/form-data" id="review-form">
                @csrf

                @error('g-recaptcha-response')
                {{ $message }}
                @enderror

                <input class="border" type="text" name="title">
                @error('title')
                {{ $message }}
                @enderror

                <input class="border" type="text" name="description">
                @error('description')
                {{ $message }}
                @enderror

                <input class="border" type="file" name="image">
                @error('image')
                {{ $message }}
                @enderror

                <button class="g-recaptcha"
                        data-sitekey="{{ config('captcha.key') }}"
                        data-callback='onSubmit'
                        data-action='submit'>Submit
                </button>

                @if ($showCaptcha)
                    @push('scripts')
                        <script>
                            function onSubmit(token) {
                                document.getElementById("review-form").submit();
                            }
                        </script>
                    @endpush
                @endif
            </form>
        @endif
    </div>
@endsection
