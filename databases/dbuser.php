<?php

$conn = mysqli_connect("localhost", "root", "", "userdata");
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());  //remove mysqli_connect_error() when releasing to the web
}
?>