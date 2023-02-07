@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success...',
            text: '{{ session('success') }}',
        })
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal...',
            text: '{{ session('error') }}',
        })
    </script>
@endif
