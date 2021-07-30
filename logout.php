<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] == 'admin') {
    unset($_SESSION['user']);
    session_destroy();
    header('Location: index.php');
}
