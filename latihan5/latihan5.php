<?php
$db_host = 'localhost'; // Nama Server
$db_user = 'root'; // User Server
$db_pass ='raja123'; // Password Server
$db_name = 'latihan'; // Nama Database
//simpan koneksi ke database ke variabel $conn
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
die ('Gagal terhubung MySQL: '. mysqli_connect_error());
}
else
    {echo "terkoneksi ke MySQL !< br>";}

$table_name = 'sales';

$sql = 'CREATE TABLE IF NOT EXISTS `' . $table_name . '` (
    `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
    `id_produk` int(11) NOT NULL,
    `tgl_transaksi` date NOT NULL,
    `kuantitas` tinyint(4) NOT NULL,
    `harga` int(11) NOT NULL,
    `id_pelanggan` int(11) NOT NULL,
    PRIMARY KEY (`id_transaksi`),
    KEY `id_produk` (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('ERROR: Tabel ' . $table_name . ' gagal dibuat: ' . mysqli_error($conn));
}
echo 'Tabel ' . $table_name . ' berhasil dibuat <br/>';

$sql = "INSERT INTO `$table_name` ( `id_produk`, `tgl_transaksi`, `kuantitas`, `harga`, `id_pelanggan`)
    VALUES ( 100, '2016-09-20', 8, 265000, 1),
           ( 100, '2016-10-11', 3, 270000, 2),
           ( 101, '2016-08-17', 8, 250000, 2),
           ( 101, '2016-08-24', 12, 380000, 2),
           ( 101, '2016-05-10', 12, 250000, 1)";

$query = mysqli_query($conn, $sql);

if (!$query) {
    die('ERROR: Data gagal dimasukkan pada tabel ' . $table_name . ': ' . mysqli_error($conn));
}
echo 'Data berhasil dimasukkan pada tabel ' . $table_name . '';

$sql = 'SELECT id_produk, tgl_transaksi, harga, kuantitas, harga*kuantitas as total_harga
        FROM sales';

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
            <td>'.$row['id_produk'].'</td>
            <td>'.$row['tgl_transaksi'].'</td>
            <td>'.$row['harga'].'</td>
            <td class="right">'.$row['kuantitas'].'</td>
             <td>'.number_format($row['total_harga'], 0, ',', '.').'</td>
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
