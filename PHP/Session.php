<?php
session_start();
include 'Base.php';
global $base;
$request = $base->prepare("SELECT * FROM Users WHERE user_id = :user_id");
$request->execute(['user_id' => $_SESSION['user_id']]);
$exist = $request-> fetch();
$_SESSION['user_id'] = $exist['user_id'];
$_SESSION['username'] = $exist['username'];
$_SESSION['email'] = $exist['email'];
$_SESSION['admin_id'] = $exist['admin_id'];
?>
