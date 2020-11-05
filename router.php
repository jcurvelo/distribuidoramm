<?php

$requests = $_SERVER['REQUEST_URI'];
$cpath = "/distribuidoramm";

switch ($requests) {
    case $cpath . '/':
        header('Location:' . $cpath . '/public/index.php');
        break;
    case $cpath . '/admin':
        header('Location:' . $cpath . '/admin/index.php');
        break;
    case $cpath . '/store':
        header('Location:' . $cpath . '/public/store.php');
        break;
    case $cpath . '/about':
        header('Location:' . $cpath . '/public/abuot.php');
        break;
    case $cpath . '/contact':
        header('Location:' . $cpath . '/public/contact.php');
        break;
    default:
        header('Location:' . $cpath . '/public/index.php');
        break;
}
