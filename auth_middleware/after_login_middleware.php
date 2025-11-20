<?php
require_once dirname(__FILE__) . "/../config.php";

session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['role'])) {
	header("location: " . BASE_URL . "login.php");
}