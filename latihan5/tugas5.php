<?php
$db_host = '127.0.0.1'; // Nama Server
$db_user = 'root'; // User Server
$db_pass ='raja123'; // Password Server
$db_name = 'latihan'; // Nama Database
//simpan koneksi ke database ke variabel $conn
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
die ('Gagal terhubung MySQL: '. mysqli_connect_error());
}

$table_name = 'Mahasiswa';

$sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
    `NIM` int(5) NOT NULL AUTO_INCREMENT,
    `Nama` varchar(20) NOT NULL,
    `Tugas` int(5) NOT NULL,
    `UTS` int(5) NOT NULL,
    `UAS` int(5) NOT NULL,
    PRIMARY KEY (`NIM`)
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('ERROR: Tabel ' . $table_name . ' gagal dibuat: ' . mysqli_error($conn));
}
echo 'Tabel ' . $table_name . ' berhasil dibuat <br/>';

$sql = "INSERT INTO `$table_name` ( `NIM`, `Nama`, `Tugas`, `UTS`, `UAS`)
    VALUES ( 25, 'Raja', 90, 90, 90),
           ( 26, 'Muhammad', 90, 90, 90),
           ( 27, 'Rahmat', 90, 90, 90),
           ( 28, 'Dodos', 90, 90, 90),
           ( 29, 'Bagus', 90, 90, 90)
           ON DUPLICATE KEY UPDATE NIM=VALUES(NIM);";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('ERROR: Data gagal dimasukkan pada tabel ' . $table_name . ': ' . mysqli_error($conn));
}
echo 'Data berhasil dimasukkan pada tabel ' . $table_name . '';

$sql = 'SELECT NIM, Nama, Tugas, UTS, UAS
        FROM Mahasiswa';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
}

echo '<html>
      <head>
          <title>Menampilkan Data Tabel MySQL Dengan mysqli_fetch_array</title>
          <style>
              body {font-family:tahoma, arial}
              table {border-collapse: collapse}
              th, td {font-size: 13px; border: 1px solid #DEDEDE; padding: 3px 5px; color: #303030}
              th {background: #CCCCCC; font-size: 12px; border-color:#B0B0B0}
              .subtotal td {background: #F8F8F8}
              .right{text-align: right}
          </style>
      </head>
      <body>
      <table>
      <thead>
          <tr>
              <th>ID PRODUK</th>
              <th>TGL TRANSAKSI</th>
              <th>HARGA</th>
              <th>KUANTITAS</th>
              <th>Total Harga</th>
          </tr>
      </thead>
      <tbody>';
    

    while ($row = mysqli_fetch_array($query))
{
    echo '<tr>
            <td>'.$row['NIM'].'</td>
            <td>'.$row['Nama'].'</td>
            <td>'.$row['Tugas'].'</td>
            <td class="right">'.$row['UTS'].'</td>
             <td class="right">'.$row['UAS'].'</td>
          </tr>';
}
echo '
        </tbody>
    </table>
</body>
</html>';

// Apakah kita perlu menjalankan fungsi mysqli_free_result()
mysqli_free_result($query);

// Apakah kita perlu menjalankan fungsi mysqli_close()
mysqli_close($conn);
