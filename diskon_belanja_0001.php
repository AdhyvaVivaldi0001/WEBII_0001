<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Diskon Belanja</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 50px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Perhitungan Diskon Belanja</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="totalBelanja">Total Belanja (Rp):</label>
                        <input type="number" class="form-control" id="totalBelanja" name="totalBelanja" required>
                    </div>
                    <div class="form-group">
                        <label for="isMember">Apakah Member?</label>
                        <select class="form-control" id="isMember" name="isMember" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung</button>
                </form>

                <?php
                function hitungTotalBelanja($totalBelanja, $isMember) {
                    $diskon = 0;

                    if ($isMember) {
                        if ($totalBelanja > 1000000) {
                            $diskon = 0.15;
                        } elseif ($totalBelanja >= 500000) {
                            $diskon = 0.10;
                        } else {
                            $diskon = 0.10;
                        }
                    } else {
                        if ($totalBelanja > 1000000) {
                            $diskon = 0.10;
                        } elseif ($totalBelanja >= 500000) {
                            $diskon = 0.05;
                        } else {
                            $diskon = 0;
                        }
                    }

                    $potongan = $totalBelanja * $diskon;
                    $totalSetelahDiskon = $totalBelanja - $potongan;

                    return [
                        'totalBelanja' => $totalBelanja,
                        'diskon' => $diskon,
                        'potongan' => $potongan,
                        'totalSetelahDiskon' => $totalSetelahDiskon
                    ];
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $totalBelanja = $_POST['totalBelanja'];
                    $isMember = $_POST['isMember'];

                    $hasil = hitungTotalBelanja($totalBelanja, $isMember);
                    echo "<div class='alert alert-success mt-3'>";
                    echo "<h5>Detail Belanja:</h5>";
                    echo "<p>Total Belanja: Rp " . number_format($hasil['totalBelanja'], 0, ',', '.') . "</p>";
                    echo "<p>Diskon: " . ($hasil['diskon'] * 100) . "%</p>";
                    echo "<p>Potongan: Rp " . number_format($hasil['potongan'], 0, ',', '.') . "</p>";
                    echo "<p>Total Setelah Diskon: Rp " . number_format($hasil['totalSetelahDiskon'], 0, ',', '.') . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
