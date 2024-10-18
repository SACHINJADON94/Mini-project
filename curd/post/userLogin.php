<?php include_once ( '../config/config.php' );
header ( 'Content-Type:application/json' );
$getData = json_decode ( file_get_contents ( 'php://input' ), true );


$username = $getData[ 'username' ];
$password = $getData[ 'password' ];

$update = "SELECT * FROM `user_login` WHERE `user_login`.`username` = '$username'";

// print_r($insert);die;
$conn = connection();
$res = mysqli_query ( $conn, $update );

if ( $res )
{
    $res = $res->fetch_assoc ();
    if ( password_verify ( $password, $res[ "password" ] ) )
    {
        setSession ();
        print_r ( json_encode ( [ 'success' => true ] ) );
    }
    else
        print_r ( json_encode ( [ 'success' => false ] ) );

}
else
{
    print_r ( json_encode ( [ 'success' => false ] ) );
}


?>
