<?php
session_start();
include 'config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();


function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}
if ($user && password_verify($password, $user['password'])) {
    if ($user['is_admin'] == 1) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = $user['is_admin'];
            header("Location: admin_dashboard.php");
            exit();
        } 
        else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
                //     // // Since the user is already fetched, no need to query again
                // $otp = rand(100000, 999999);
                // $otp_expiry = date("Y-m-d H:i:s", strtotime("+3 minutes"));
                // $subject = "Your OTP for Login";
                // $message = "Your OTP is: $otp";

                // $mail = new PHPMailer(true);
                // try {
                //     $mail->isSMTP();
                //     $mail->Host = 'smtp.gmail.com';
                //     $mail->SMTPAuth = true;
                //     $mail->Username = 'shanalvi120@gmail.com'; // Host email
                //     $mail->Password = 'uhxb xjyw qaeb micl'; // App password of your host email
                //     $mail->Port = 465;
                //     $mail->SMTPSecure = 'ssl';
                //     $mail->isHTML(true);
                //     $mail->addAddress($email);
                //     $mail->setFrom('example@gmail.com', 'Your Login OTP'); // Sender's Email & Name
                //     $mail->Subject = $subject;
                //     $mail->Body = $message;

                //     $mail->send();

                //     // Update the user's OTP and expiry in the database
                //     $updateStmt = $pdo->prepare("UPDATE users SET otp = ?, otp_expiry = ? WHERE id = ?");
                //     $updateStmt->execute([$otp, $otp_expiry, $user['id']]);

                //     $_SESSION['temp_user'] = ['id' => $user['id'], 'otp' => $otp];
                //     header("Location: otp.php");
                //     exit();
                // } catch (Exception $e) {
                //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                // }
            header("Location:   dashboard.php");
            exit();
        }
    } else {
    ?>
        <script>
            alert("Invalid Email or Password. Please try again.");
            function navigateToPage() {
                window.location.href = 'index.php';
            }
            window.onload = function() {
                navigateToPage();
            }
        </script>
        <?php
    }
?>
