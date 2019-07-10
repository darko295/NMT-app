<?php
session_start();
include "../class/prodavac.php";
$user = new  prodavac();
$user -> logout($_SESSION['username'], 0);