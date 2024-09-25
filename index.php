<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Bunga Tunggal dan Majemuk</title>
    <link rel="stylesheet" href="style.css">

    <script>
        // Fungsi untuk memformat input angka dengan titik sebagai pemisah ribuan
        function formatRupiah(input, event) {
            let value = input.value.replace(/\./g, ''); // Menghapus titik yang sudah ada
            let number = parseInt(value, 10);
            
            if (!isNaN(number)) {
                // Memformat angka dengan titik setiap ribuan
                input.value = number.toLocaleString('id-ID');
            } else {
                input.value = ''; // Kosongkan jika bukan angka
            }
        }
    </script>

</head>

<body>
    <div class="container">
        <h1>Perhitungan Bunga</h1>
        <form method="POST" action="">
            <label for="principle">Jumlah Pokok (Rp):</label>
            <input type="text" id="principle" name="principle" required onkeyup="formatRupiah(this, event)"><br><br>

            <label for="rate">Suku Bunga (% per tahun):</label>
            <input type="number" id="rate" name="rate" step="0.01" required><br><br>

            <label for="time">Jangka Waktu (tahun):</label>
            <input type="number" id="time" name="time" required><br><br>

            <label for="type">Jenis Bunga:</label>
            <select id="type" name="type" required>
                <option value="simple">Bunga Tunggal</option>
                <option value="compound">Bunga Majemuk</option>
            </select><br><br>

            <button type="submit" name="calculate">Hitung Bunga</button>
        </form>

        <div id="result">
            <h2>Hasil:</h2>
            <?php
            if (isset($_POST['calculate'])) {
                // Mengambil nilai dari form, menghapus titik dari inputan jumlah pokok
                $principle = (float) str_replace('.', '', $_POST['principle']);
                $rate = (float) $_POST['rate'];
                $time = (float) $_POST['time'];
                $type = $_POST['type'];

                // Validasi input
                if ($principle > 0 && $rate > 0 && $time > 0) {
                    if ($type == 'simple') {
                        // Bunga Tunggal: A = P + (P * r * t)
                        $interest = $principle * ($rate / 100) * $time;
                        $totalAmount = $principle + $interest;
                    } else if ($type == 'compound') {
                        // Bunga Majemuk: A = P(1 + r/n)^(nt)
                        $totalAmount = $principle * pow((1 + $rate / 100), $time);
                        $interest = $totalAmount - $principle;
                    }

                    // Menampilkan hasil
                    echo "Jumlah Pokok: Rp " . number_format($principle, 2, ',', '.') . "<br>";
                    echo "Bunga: Rp " . number_format($interest, 2, ',', '.') . "<br>";
                    echo "Total: Rp " . number_format($totalAmount, 2, ',', '.') . "<br>";
                } else {
                    echo "<p>Harap masukkan nilai yang valid!</p>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
