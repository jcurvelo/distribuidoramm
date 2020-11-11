<?php
session_start();
unset($_SESSION['session_id']);
unset($_SESSION['username']);
unset($_SESSION['access_level']);
session_unset();
unset($_COOKIE['PHPSESSID']);
// header('Location: ./index.php');