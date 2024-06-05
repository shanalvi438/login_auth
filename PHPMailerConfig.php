<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'shanalvi120@gmail.com'; 
        $mail->Password = 'uhxb xjyw qaeb micl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

       
        $mail->setFrom('shanalvi120@gmail.com', 'Email Verification');
        $mail->addAddress($email);

        
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body    = "Your OTP is $otp. It is valid for 1 hour.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
?>
