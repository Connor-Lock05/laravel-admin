@props(['models'])
@extends('admin::layout')
@section('content')
    <div class="grid grid-cols-3 gap-4 w-full text-center">
        <p class="font-semibold underline">Model</p>
        <p class="font-semibold underline">Number of Records</p>
        <p class="font-semibold underline">View</p>

        @foreach($models as $model)
            <p>{{ \ConnorLock05\LaravelAdmin\get_formatted_class_name($model) }}</p>
            <p>{{ $model::count() }}</p>
            <span>
                @include('admin::button', ['href' => route('admin.model.index', [base64_encode($model)]), 'label' => 'View'])
            </span>
        @endforeach

    </div>
@endsection