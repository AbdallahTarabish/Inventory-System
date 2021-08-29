@if(session()->has('success'))
@section('script')
    <script>
        Swal.fire({
            type: 'success',
            title: "{{session('success')}}",
        });
    </script>

@endsection

@endif
@if(session()->has('error'))

@section('script')
    <script>
        Swal.fire({
            type: 'error',
            title: "{{session('error')}}",
        });
    </script>

@endsection
@endif


