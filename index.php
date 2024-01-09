<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon Makanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
            $totalHarga = 0;
            $diskonPersen = 0;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Fungsi untuk menghitung diskon
                function hitungDiskonMakanan($totalHarga, $diskonPersen) {
                    $diskon = ($diskonPersen / 100) * $totalHarga;
                    return $diskon;
                }

                // Mengambil nilai dari formulir
                $totalHarga = isset($_POST["total_harga"]) ? $_POST["total_harga"] : 0;
                $diskonPersen = isset($_POST["diskon_persen"]) ? $_POST["diskon_persen"] : 0;

                // Validasi input sebagai angka
                if (!is_numeric($totalHarga) || !is_numeric($diskonPersen)) {
                    echo '<div class="result">';
                    echo 'Masukkan angka yang valid.';
                    echo '</div>';
                    die();
                }

                // Menghitung diskon
                $diskon = hitungDiskonMakanan($totalHarga, $diskonPersen);

                // Menghitung total harga setelah diskon
                $totalSetelahDiskon = $totalHarga - $diskon;
            }
        ?>

        <h1>Kalkulator Diskon Makanan</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="total_harga">Total Harga Makanan:</label>
            <input type="text" name="total_harga" required value="<?php echo $totalHarga; ?>">
            
            <label for="diskon_persen">Diskon (%):</label>
            <input type="text" name="diskon_persen" required value="<?php echo $diskonPersen; ?>">
            
            <button type="submit">Hitung Diskon</button>
        </form>

        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo '<div class="result">';
                echo "<p>Total Harga Makanan: Rp " . number_format($totalHarga, 2) . "</p>";
                echo "<p>Diskon " . $diskonPersen . "%: Rp " . number_format($diskon, 2) . "</p>";
                echo "<p>Total Harga Setelah Diskon: Rp " . number_format($totalSetelahDiskon, 2) . "</p>";
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
