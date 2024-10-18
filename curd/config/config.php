<?php
// ini_set ( 'display_errors', 'on' );
// error_reporting ( E_ALL );


session_start ();

function sessionStart ()
{
	$_SESSION[ 'auth' ] = false;
}

function setSession ()
{
	$_SESSION[ 'auth' ] = true;
}

function validateSession ()
{
	if ( empty ( $_SESSION[ 'auth' ] ) || ! isset ( $_SESSION[ 'auth' ] ) || $_SESSION[ 'auth' ] == 0 )
	{
		return false;
	}
	else
	{
		return true;
	}
}
function connection ()
{
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "curd";
	$db_port = 3306;

	$conn = mysqli_connect ( $db_host, $db_user, $db_pass, $db_name, $db_port );
	if ( ! $conn )
	{
		echo "Connection Failed";
		die;

	}
	return $conn;

}
