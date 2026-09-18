<?php
$angka1 = $_GET['angka1'] ?? '';
$angka2 = $_GET['angka2'] ?? '';
$operator = $_GET['operator'] ?? '' ;
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
    <h1 > kalkulator </h1>
<form action="#hasil" method="get">
<table  border ="1">
<tbody>
    
<tr>
    <td> angka pertama </td>
    <td>:</td>
    <td> 
        <input type="number" id="angka1" name="angka1"><br></td>
</tr>
<tr>
    <td>operator</td>
    <td>:</td>
    <td> 
        <input type="text" id="operator" name="operator"><br></td>
</tr>
<tr>
    <td>angka kedua</td>
    <td>:</td>
    <td> 
        <input type="number" id="angka2" name="angka2"><br></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td> <input type="submit" value="Submit">
        <input type="reset" value="reset">
    </td>
</tr>
<td >Hasil</td>
<td id="hasil"> <?php  if ($operator == "tambah"){
                echo $angka1 + $angka2;}
            elseif ($operator == "kurang"){
                echo $angka1 - $angka2;}
            elseif ($operator == "kali"){
                echo $angka1 * $angka2;}
            elseif ($operator == "bagi"){
                echo $angka1 / $angka2;}
            else {echo "tidak valid";}
    ?></td>
</tr>

</tbody>
</table>

</form>
</center>
</body>
</html>



