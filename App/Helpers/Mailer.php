<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \App\Helpers\DotEnv;
/**
 * Hash:
 */
class Mailer {

    /**
     * Setup du SMTP
     */
    private static function smtpSetup($TSL = false) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                        //Send using SMTP
        $mail->SMTPDebug = SMTP::DEBUG_CLIENT;                  //Enable verbose debug output
        $mail->SMTPAuth = true;                                 //Enable SMTP authentication
        $mail->SMTPSecure = $TSL ?                              //******************************//
        PHPMailer::ENCRYPTION_STARTTLS                          //Enable implicit TLS encryption//
        : PHPMailer::ENCRYPTION_SMTPS;                          //******************************//
        $mail->Host = getenv('SMTP_SERVER');                    //Set the SMTP server to send through
        $mail->Port = $TSL ? 587 : 465;                          //TCP port to connect to//


        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Username   = getenv('SMTP_MAIL_ADRESS');         //SMTP username
        $mail->Password   = getenv('SMTP_MAIL_PASSWORD');       //SMTP password


        return $mail;
    }

    /**
     * Envoie un mail
     */
    public static function sendMail($emailTo, $senderName, $senderEmail, $subject, $message, $attachment = null) {
        //Create an instance; passing `true` enables exceptions
        (new DotEnv(ROOT . '.env'))->load();

        try {
            $mail = Mailer::smtpSetup(false);
            //Recipients
            $mail->setFrom($senderEmail, $senderName);
            $mail->addAddress($emailTo);                            //Name is optional
        
            //Attachments
            if ($attachment != null) {
                $mail->addAttachment($attachment);                  //Add attachments
            }
        
            //Content
            $mail->isHTML(true);                                   //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }



}
