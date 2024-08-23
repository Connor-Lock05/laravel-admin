@props(['model', 'id', 'record', 'fields'])

@extends('admin::layout')
@section('content')
    <div class="flex justify-end items-center gap-4 w-full h-8">
        @include('admin::button', ['href' => route('admin.model.edit', [$model, $id]), 'label' => 'Edit Record'])
        @include('admin::button', ['onclick' => 'deleteRecord();', 'label' => 'DELETE', 'danger' => true])
    </div>

    <div class="flex flex-col justify-start items-center gap-4 w-full h-fit">
        @foreach($fields as $field => $type)
            <div class="flex justify-between items-center w-full">
                <p class="font-semibold">{{ \Illuminate\Support\Str::headline($field) }}</p>

                <p>{{ $type->renderValue($record, $field) }}</p>
            </div>

            @if (!$loop->last)
                <hr class="w-full">
            @endif

        @endforeach
    </div>

    @push('scripts')
        <script>
            function deleteRecord()
            {
                let form = document.createElement('FORM');
                form.action = '{{ route('admin.model.destroy', [$model, $id]) }}';
                form.method = "POST";

                let methodInput = document.createElement('INPUT');
                methodInput.name = '_method';
                methodInput.value = "DELETE";

                let csrfInput = document.createElement('INPUT');
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';

                form.appendChild(methodInput);
                form.appendChild(csrfInput);

                form.style.display = 'none';

                document.body.appendChild(form);

                form.submit();
            }
        </script>
    @endpush

@endsection