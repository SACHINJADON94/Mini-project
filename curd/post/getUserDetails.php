<?php include_once '../config/config.php';
header ( 'Content-Type:application/json' );

if ( isset ( $_POST ) )
{
    $uid = json_decode ( file_get_contents ( 'php://input' ), true );

    $deleteData = "SELECT * FROM `user` WHERE `id`={$uid[ 'uid' ]};";
    // print_r ( $deleteData );die;
    $conn = connection();
    $res = mysqli_query ( $conn, $deleteData );
    if ( $res )
    {
        echo json_encode ( [ 'type' => 'success', $res->fetch_assoc () ] );
    }
    else
    {
        echo json_encode ( [ 'type' => 'error' ] );
    }
}

?>