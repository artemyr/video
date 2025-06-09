@extends('layouts.admin')

@section('content')
    <form action="" method="post">
        @csrf

        <x-forms.text-input
            placholder="Code"
        ></x-forms.text-input>

    </form>
@endsection
