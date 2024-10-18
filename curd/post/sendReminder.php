<?php include_once '../config/config.php';
ini_set ( 'display_errors', 'on' );
error_reporting ( E_ALL );
header ( 'Content-Type:application/json' );

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer ( true );

$email = json_decode ( file_get_contents ( 'php://input' ), true )[ 'email' ];
try
{
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP ();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'yugox.charu@gmail.com';                     //SMTP username
    $mail->Password   = 'pnytbcchcymqjpgy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom ( 'yugox.charu@gmail.com', 'Mailer' );
    $mail->addAddress ( $email, 'Joe User' );     //Add a recipient

    $mail->Subject = 'Send Reminder';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    // $mail->send ();

    if ( $mail->send () )
    {
        print_r ( json_encode ( [ 'success' => true ] ) );
        exit;
    }
    else
    {
        print_r ( json_encode ( [ 'success' => false ] ) );
        exit;
    }
}
catch ( Exception $e )
{
    print_r ( json_encode ( [ 'success' => false ] ) );
    exit;
}
