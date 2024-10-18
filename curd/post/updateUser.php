<?php include_once ( '../config/config.php' );
header ( 'Content-Type:application/json' );
$getData = json_decode ( file_get_contents ( 'php://input' ), true );


$first_name   = $getData[ 'first_name' ];
$last_name    = $getData[ 'last_name' ];
$email        = $getData[ 'email' ];
$phone_number = $getData[ 'phone_number' ];
$date         = $getData[ 'date' ];
$uid          = $getData[ 'user_id' ];

$update = "UPDATE `user` SET `first_name`='$first_name',`last_name`='$last_name',`email_address`='$email',`phone_number`='$phone_number',`end_of_subscription`='$date' WHERE `id`=$uid";

// print_r($insert);die;
$conn = connection();
$res = mysqli_query ( $conn, $update );

if ( $res )
{
    print_r ( json_encode ( [ 'success' => true ] ) );
}
else
{
    print_r ( json_encode ( [ 'success' => false ] ) );
}


?>