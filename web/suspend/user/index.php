<?php
error_reporting(NULL);
ob_start();
session_start();
$TAB = 'USER';
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

// Are you admin?
if ($_SESSION['user'] == 'admin') {
    if (!empty($_GET['user'])) {
        $v_username = escapeshellarg($_GET['user']);
        exec (VESTA_CMD."v_suspend_user ".$v_username, $output, $return_var);
    }
    if ($return_var != 0) {
        $error = implode('<br>', $output);
        if (empty($error)) $error = 'Error: vesta did not return any output.';
            $_SESSION['error_msg'] = $error;
    }
    unset($output);

}

header("Location: /list/user/");