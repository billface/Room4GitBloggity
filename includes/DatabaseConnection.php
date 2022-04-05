<?php

$pdo = new PDO('mysql:host=mysql;dbname=room4Two', 'room4TwoUser', 'Mypassword1!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);