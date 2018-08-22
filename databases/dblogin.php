<?php

$conn = mysqli_connect("localhost", "root", "", "login");
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());  //remove mysqli_connect_error() when releasing to the web
}
?>