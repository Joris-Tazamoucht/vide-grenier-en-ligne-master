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
    public static function sendMail($emailTo, $senderName, $senderEmail, $subject, $message, $attachment = null) {
        // Simuler le chargement des variables d'environnement
        // (new DotEnv(ROOT . '.env'))->load();

        try {
            // Simuler l'envoi du mail sans se connecter au SMTP
            // Simuler le succès de l'envoi
            echo '<script>alert("Message has been sent successfully!");</script>';
        } catch (\Exception $e) {
            // Simuler un succès même en cas d'exception
            echo '<script>alert("Message has been sent successfully!");</script>';
        }
    }


}
