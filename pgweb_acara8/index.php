<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 50px; /* Padding yang lebih besar untuk memberi ruang */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Menyusun isi secara kolom */
        }
        table {
            width: 80%; /* Lebar tabel */
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border: 2px solid #007BFF; /* Border tebal untuk tabel */
            border-radius: 8px; /* Sudut melengkung */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            text-align: center;
            border-radius: 4px; /* Sudut melengkung pada tombol */
        }
        .action-button:hover {
            background-color: #c82333;
        }
        .no-results {
            margin: 20px 0;
            font-size: 18px;
            color: #555; /* Warna teks hasil yang tidak ada */
        }
        .center-text {
            text-align: center; /* Memusatkan teks di dalam sel */
        }
    </style>
</head>
<body>

<h2>Data Kecamatan</h2>

<?php
// Sesuaikan dengan setting MySQL default
$servername = "localhost";
$username = "root";
$password = ""; // Default tanpa password
$dbname = "acara8_pgweb_frendy";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("<div class='no-results'>Connection failed: " . $conn->connect_error . "</div>");
}

// Query untuk mengambil data dari tabel 'kecamatan_data'
$sql = "SELECT id, kecamatan, longitude, latitude, luas, jumlah_penduduk FROM kecamatan_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Tampilkan data dalam tabel
    echo "<table>
            <tr>
                <th>Kecamatan</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Luas</th>
                <th>Jumlah Penduduk</th>
                <th>Aksi</th>
            </tr>";

    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["kecamatan"] . "</td>
                <td>" . $row["longitude"] . "</td>
                <td>" . $row["latitude"] . "</td>
                <td>" . $row["luas"] . "</td>
                <td align='right'>" . $row["jumlah_penduduk"] . "</td>
                <td class='center-text'>
                    <form method='post' action='hapus.php'>
                        <input type='hidden' name='id' value='" . $row["id"] . "'>
                        <input type='submit' class='action-button' value='Hapus'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<div class='no-results'>0 results</div>";
}

// Menutup koneksi
$conn->close();
?>

</body>
</html>
