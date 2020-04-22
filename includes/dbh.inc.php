<?php
// Change the values bellow match a setup of your db
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";


$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}