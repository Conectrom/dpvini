<?php

$koneksi = mysqli_connect("mysql-dp","dpuser","123456","dp-conectrom");

if(!$koneksi){
    die('Connection Failed'. mysqli_connect_error());
}
