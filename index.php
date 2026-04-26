<?php
session_start();
// Entry point utama sistem
require_once 'includes/header.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require_once 'pages/home.php';
        break;
    case 'consultation':
        require_once 'pages/consultation.php';
        break;
    case 'result':
        require_once 'pages/result.php';
        break;
    case 'history':
        require_once 'pages/history.php';
        break;
    case 'detail':
        require_once 'pages/detail.php';
        break;
    default:
        require_once 'pages/home.php';
        break;
}

require_once 'includes/footer.php';
?>