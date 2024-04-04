<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '/var/www/html/ATM/gsbextranetb3/vendors/PHPMailer/src/Exception.php';
require '/var/www/html/ATM/gsbextranetb3/vendors/PHPMailer/src/PHPMailer.php';
require '/var/www/html/ATM/gsbextranetb3/vendors/PHPMailer/src/SMTP.php';
class EmailModel {
    public function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com"; 
        $mail->SMTPAuth = true;
        $mail->Username   =  'projetgsbatm@gmail.com';    //Adresse email à utiliser
        $mail->Password   =  'sbtfgqiwhbciceog';         //Mot de passe de l'adresse email à utiliser

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail-> setFrom("projetgsbatm@gmail.com", "GSB");
        $mail->addAddress($to);
        $mail->MsgHTML($message);
        $mail->Subject = $subject;

        if ($mail->send()) {
            return true;
        } else {
            return $mail->ErrorInfo;
        }
    }
}
