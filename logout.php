<?php

    if (version_compare(phpversion(), '5.4.0', '<')) {
        if(session_id() == '') {
           session_start();
        }
    }
    else
    {
       if (session_status() == PHP_SESSION_NONE) {
           session_start();
       }
    }

    if ( isset( $_SESSION['logged'] ) )
    {
        unset( $_SESSION['logged']);
        session_destroy();
        header("Location: ?page=home/accueil");
    }
?>