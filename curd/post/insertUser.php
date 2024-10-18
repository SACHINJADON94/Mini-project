<?php include_once ( '../config/config.php' );
if ( isset ( $_POST[ 'submit' ] ) )
{
	$first_name   = $_POST[ 'first_name' ];
	$last_name    = $_POST[ 'last_name' ];
	$email        = $_POST[ 'email' ];
	$phone_number = $_POST[ 'phone_number' ];
	$date         = $_POST[ 'date' ];

	$insert = "INSERT INTO `user`(`first_name`, `last_name`, `email_address`, `phone_number`,`end_of_subscription`) VALUES ('" . $first_name . "','" . $last_name . "','" . $email . "','" . $phone_number . "','" . $date . "')";
	// print_r($insert);die;
	$conn = connection ();
	$res  = mysqli_query ( $conn, $insert );
	if ( $res )
	{
		header ( "location:../index.php" );
	}
	else
	{
		header ( "location:../index.php" );
	}


}

?>
