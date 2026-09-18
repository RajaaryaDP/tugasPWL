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