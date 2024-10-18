<?php include_once ( '../config/config.php' );
header ( 'Content-Type:application/json' );
$getData = json_decode ( file_get_contents ( 'php://input' ), true );


$username = $getData[ 'username' ];
$password = password_hash ( $getData[ 'password' ], PASSWORD_ARGON2ID );

$update = "SELECT * FROM `user_login` WHERE `user_login`.`username` = '$username'";

// print_r($insert);die;
$conn = connection ();
$res  = mysqli_query ( $conn, $update );

if ( $res )
{
    if ( $res->num_rows <= 0 )
    {
        try
        {
            mysqli_query ( $conn, "INSERT INTO `user_login`(`username`, `password`) VALUES ('$username','$password')" );
            print_r ( json_encode ( [ 'success' => true, 'username' => true ] ) );

        }
        catch ( \Throwable $th )
        {
            print_r ( json_encode ( [ 'success' => true, 'username' => false ] ) );

        }
    }
    else
    {
        print_r ( json_encode ( [ 'success' => true, 'username' => false ] ) );
    }

}
else
{
    print_r ( json_encode ( [ 'success' => false ] ) );
}


?>
