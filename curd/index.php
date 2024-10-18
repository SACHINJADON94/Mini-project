<?php
require "config/config.php";
include_once ( 'inc/header.php' );

if ( empty ( $_SESSION[ 'auth' ] ) || ! isset ( $_SESSION[ 'auth' ] ) )
{
    sessionStart ();
    include_once ( 'pages/login.php' );
}
else
{
    include_once ( 'pages/user-list.php' );
}

include_once ( 'inc/footer.php' );
