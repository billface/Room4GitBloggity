<?php

$pdo = new PDO('mysql:host=localhost;dbname=room4Two', 'room4TwoUser', 'mypassword');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);