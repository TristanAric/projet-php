<?php

session_start();

$_SESSION = [];
 
$_SESSION['login'] = false;

header("location: index.php".$_SESSION['login']);
