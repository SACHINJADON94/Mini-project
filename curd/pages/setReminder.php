<?php include_once( '../config/config.php' );
print_r($_POST);die;
if ( isset( $_POST[ 'submit' ] ) )
{
    $setReminderTime = $_POST[ 'setReminder' ];
    $user_id         = $_POST[ 'user_id' ];

    $insert = "INSERT INTO `set_reminder`(`setReminder`, `user_id`) VALUES ('" . $setReminderTime . "','" . $user_id . "')";
    $res    = mysqli_query ( $conn, $insert );
    if ( $res )
    {
        move_uploaded_file ( $temp_profile, $profile_folder );

        //echo "Inserted";
        header ( "location:../index.php" );

    }
    else
    {
        echo "fail";

    }


}

?>