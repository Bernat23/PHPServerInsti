<?php 
require_once "bd.php";

$dbh = connexio();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(1, '2023-01-31')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(2, '2023-02-28')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(3, '2023-03-31')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(4, '2023-04-30')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(5, '2023-05-30')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(6, '2023-06-30')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(7, '2023-10-30')");
$stmt -> execute();
$stmt = $dbh -> prepare("INSERT INTO fase (num, dataFinal ) VALUES(8, '2023-10-30')");
$stmt -> execute();
?>