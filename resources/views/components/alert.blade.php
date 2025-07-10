@if (session('success'))

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Pronto!",
                html: "{!! session('success') !!}",
                icon: "success"
            });
        });
    </script>

@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                html: "{!! session('error') !!}",
                icon: "error"
            });
        });
    </script>
@endif

@if ($errors->any())
    {{-- <div class="alert-error">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>     --}}

    @php
        $message = '';
        foreach ($errors->all() as $error) {
            $message .= $error . '<br>';
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                html: "{!! $message !!}",
                icon: "error"
            });
        });
    </script>
@endif