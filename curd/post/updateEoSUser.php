<?php include_once ( '../config/config.php' );
header ( 'Content-Type:application/json' );

if ( isset ( $_POST ) )
{
    $endOfSubscription = json_decode ( file_get_contents ( 'php://input' ), true );

    $updateData = "UPDATE `user` SET `end_of_subscription`='{$endOfSubscription[ 'eos' ]}' WHERE `id`={$endOfSubscription[ 'uid' ]};";
    // print_r ( $updateData );die;
    $conn = connection ();
    $res  = mysqli_query ( $conn, $updateData );
    if ( $res )
    {
        echo json_encode ( [ 'type' => 'success' ] );
    }
    else
    {
        echo json_encode ( [ 'type' => 'error' ] );
    }
}

?>
