<?php
$username = $_GET['username'] ?? '';
$nim = $_GET['nim'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <h1 > login dulu </h1>
<form action="#hasil" method="get">
<table  border ="1">
<tbody>
    
<tr>
    <td> nama </td>
    <td>:</td>
    <td> 
        <input type="text" id="username" name="username"><br></td>
</tr>
<tr>
    <td>nim</td>
    <td>:</td>
    <td> 
        <input type="number" id="nim" name="nim"><br></td>
</tr>

<tr>
    <td></td>
    <td></td>
    <td > <input type="submit" value="Submit">
        <input type="reset" value="reset">
    </td>
</tr>

<td >Hasil</td>
<td id="hasil"> <?php  
        $myusername = "Raja";
        $myNIM = "2507411029";

// menggunakan operator ternary
        $keterangan = ($username === $myusername && $nim === $myNIM) ? "selamat datang": "username atau nim salah";

// menampilkan jawaban
        echo $keterangan;
    ?></td>
</tr>

</tbody>
</table>

</form>
</center>
</body>
</html>



