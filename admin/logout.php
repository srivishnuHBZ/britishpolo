<?php



session_start();

unset($_SESSION['aid']);
unset($_SESSION['ausername']);

header("Location: ./");
