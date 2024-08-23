@use(ConnorLock05\LaravelAdmin\Interfaces\Type)
@use(Illuminate\Support\Str)
@props(['model', 'id', 'record', 'fields'])
@php
    /** @var array<string, Type> $fields */
@endphp

@extends('admin::layout')
@section('content')
    <form action="{{ route('admin.model.update', [$model, $id]) }}" method="POST" class="flex flex-col justify-start items-center gap-4 w-full h-fit">
        @csrf
        @method('PATCH')

        @foreach($fields as $field => $type)
            <div class="flex justify-between items-start w-full">
                <label for="{{ $field }}_field">
                    {{ Str::headline($field) }}
                </label>

                {!! $type->render($field, $record->$field) !!}
            </div>
        @endforeach

        <div class="flex justify-end items-center w-full">
            @include('admin::button', ['onclick' => '', 'submit' => 'true', 'label' => 'Submit'])
        </div>
    </form>
@endsection