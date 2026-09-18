<?php 
$nama = $_GET['nama'] ?? '';
$nim = $_GET['nim'] ?? '';
$semester = $_GET['semester'] ?? '';
$hobi = $_GET['hobi'] ?? '';
$umur = $_GET['umur'] ?? '';
$citacita = $_GET['citacita'] ?? '';
$prodi = $_GET['prodi'] ?? '';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <table border="1">
    <!--Tr adalah tabel baris-->
    <!--Td adalah tabel kolom-->
    <!--th adalah tabel untuk header-->
    <!--bgcolor untuk memberi warna di tabel-->
    <!--style fontsize untuk mengatur ukuran teks-->
    <!--colspan dan rowspan untuk menggabungkan tabel-->
<tbody>
<tr >
<th bgcolor ="yellow" style="font-size: 25px;" colspan = "6"> BIODATA KTP </th>
</tr>
<tr>
    <!--href untuk menaruh link ke file lain-->
    <!--img untuk menambahkan foto-->
    <!--alt untuk memberikan nama pada foto-->
    <!--width dan height untuk mengatur ukuran foto-->
<td rowspan = "10" colspan = "3"> <a href ="webdas.html"> <img src = "foto.jpeg" alt = "fotodiri" height="500px" width ="250px"></td>
<td> Nama </td>
<td colspan = "3"> <?=  $nama ?> </td>
</tr>
<tr>
<td>nim </td>
<td><?=  $nim ?></td>
</tr>
<tr>
<td> Jenis Kelamin</td>
<td><?=  $semester ?></td>
</tr>
<tr>
<td>Hobi</td>
<td><?=  $hobi ?></td>
</tr>
<tr>
<td>umur</td>
<td><?=  $umur ?></td>
</tr>
<tr>
<td>Cita-Cita</td>
<td><?=  $citacita ?></td>
</tr>
<tr>
<td>Prodi</td>
<td><?=  $prodi ?></td>
</tr>


</tbody>
</table>

</body>
</html>