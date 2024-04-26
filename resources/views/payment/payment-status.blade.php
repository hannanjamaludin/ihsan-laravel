<!DOCTYPE html>
<html>
<head>
    <title>Berjaya</title>
</head>
<body>
    <h1>Transaksi {{ $status }}</h1>
    <p>Anda akan dibawa ke skrin pembayaran dalam beberapa saat...</p>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('pembayaran.yuran_student', ['studentId' => $student_id]) }}";
        }, 1500); 
    </script>
</body>
</html>
