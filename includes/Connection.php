<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);