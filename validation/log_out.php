<?php
    # start session
    session_start();

    # unset session variables
    unset($_SESSION['user_email']);

    #destroy session
    session_destroy();

    # redirect user back tto where they were before
    header('Location: '.$_SERVER['HTTP_REFERER']);
?>