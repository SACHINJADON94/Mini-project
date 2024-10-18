<?php include_once ( 'inc/header.php' ); ?>

<?php

if ( empty ( $_GET[ 's' ] ) || ! isset ( $_GET[ 's' ] ) )
{
    session_destroy();
    echo session_status();
    include_once ( 'pages/user_login.php' );
    
}
else
{
    session_start ( [ 's' => $_GET[ 's' ] ] );
    $url = strtok($url, '?');
    include_once ( 'pages/all_users.php' );

}
?>

<?php include_once ( 'inc/footer.php' ); ?>
