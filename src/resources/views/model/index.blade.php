@props(['records', 'indexFields', 'model'])
@php
    /** @var \Illuminate\Pagination\LengthAwarePaginator $records */
    /** @var array $indexFields */
@endphp
@extends('admin::layout')
@section('content')
    <div class="flex justify-end items-center w-full h-8">
        @include('admin::button', ['href' => route('admin.model.create', [$model]), 'label' => 'Create New'])
    </div>

    <div class="grid grid-cols-{{ count($indexFields) + 1 }} gap-2 w-full h-fit border-collapse text-center">
        @foreach(array_merge($indexFields, ['View']) as $header)
            <p><strong>{{ \Illuminate\Support\Str::title($header) }}</strong></p>
        @endforeach
        @forelse($records as $record)
            @foreach($indexFields as $field)
                <p>{{ $record->$field }}</p>
            @endforeach

            <div>
                @include('admin::button', ['href' => route('admin.model.show', [$model, $record->getKey()]), 'label' => 'View'])
            </div>
        @empty
            <p class="col-span-full font-semibold">No Records Found</p>
        @endforelse
    </div>

    {!! $records->links('admin::pagination-links') !!}
@endsection