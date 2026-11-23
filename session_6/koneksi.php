<?php
    date_default_timezone_set("Asia/jakarta");

    $conn = mysqli_connect("localhost", "root", "", "db_php_riskyandrean");
    if (mysqli_connect_errno()) {
    echo "Koneksi database gagal! : --> " . mysqli_connect_error();
    }
?>