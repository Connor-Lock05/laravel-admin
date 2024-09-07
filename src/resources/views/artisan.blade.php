@extends('admin::layout')
@section('content')
    <div class="flex justify-between items-center w-full gap-2">
        <span class="text-nowrap">php artisan </span>
        <input
            type="text"
            id="artisan-command-input"
            class="w-full border border-black p-2 rounded-full"
            placeholder="Command"
        />
        <button class="w-6 h-full" type="button" onclick="sendCommand();" title="Send" id="send-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path fill="#000000" d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80L0 432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z"/>
            </svg>
        </button>
    </div>
    <textarea
        rows="20"
        id="artisan-output"
        readonly
        class="w-full border border-black p-2"
        placeholder="Output"
    ></textarea>

    @push('scripts')
        <script>
            function sendCommand()
            {
                fetch('{{ route('admin.artisan.send') }}', {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        command: document.querySelector('#artisan-command-input').value
                    })
                }).then(response => {
                    if (response.ok)
                    {
                        return response.json();
                    }

                    throw response;
                }).then(json => {
                    document
                        .querySelector('#artisan-output')
                        .innerHTML = json.output;
                }).catch(response => {
                    document
                        .querySelector('#artisan-output')
                        .innerText = `Request failed with status ${response.status}`;
                })
            }

            document
                .querySelector('#artisan-command-input')
                .addEventListener('keydown', (event) => {
                    if (event.key.toLowerCase() === "enter")
                    {
                        event.preventDefault();
                        document
                            .querySelector('#send-btn')
                            .click();
                    }
                })
        </script>
    @endpush
@endsection
