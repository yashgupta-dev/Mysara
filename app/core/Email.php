<?php

namespace app\core;

require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    /**
     * @var string logFile is the file path of the logs.
     */
    public static $logFile = CORE . '/logs/error_logs.log';

    /**
     * @var PHPMailer
     */
    private static $mailer;

    /**
     * @var string
     */
    private static $to;

    /**
     * @var string
     */
    private static $subject;

    /**
     * @var string
     */
    private static $message;

    /**
     * Initialize the Email class.
     */
    public static function init()
    {
        // Create a new PHPMailer instance
        self::$mailer = new PHPMailer(true);

        // Enable SMTP
        self::$mailer->isSMTP();

        // SMTP server settings (Replace with your SMTP server and credentials)
        self::$mailer->Host = Host;
        self::$mailer->SMTPAuth = SMTPAuth;
        self::$mailer->Username = Username;
        self::$mailer->Password = Password;
        self::$mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        self::$mailer->Port = Port;

        // Set the sender's email and name
        self::$mailer->setFrom(Mail_From, Mailer_Name);
    }

    /**
     * Set the recipient's email address.
     *
     * @param string $to
     */
    public static function to($to)
    {
        self::$to = $to;
    }

    /**
     * Set the email subject.
     *
     * @param string $subject
     */
    public static function subject($subject)
    {
        self::$subject = $subject;
    }

    /**
     * Set the email message.
     *
     * @param string $message
     */
    public static function message($message)
    {
        self::$message = $message;
    }

    /**
     * Send an email.
     *
     * @return bool
     */
    public static function sendEmail()
    {
        self::init(); // Initialize the email settings

        try {
            // Add recipient email address
            self::$mailer->addAddress(self::$to);

            // Content
            self::$mailer->isHTML(true);

            // Email subject and body
            self::$mailer->Subject = self::$subject;
            self::$mailer->Body = self::$message;

            // Send the email
            self::$mailer->send();

            return true;
        } catch (Exception $e) {
            // Handle exceptions if needed
            self::_writeLog(self::$logFile, $e->getMessage());
            return false;
        }
    }

    /**
     * Write log to the specified file.
     *
     * @param string $file
     * @param string $contents
     */
    private static function _writeLog($file, $contents)
    {
        $file = fopen(self::$logFile, "a");
        $contents = date("Y-m-d h:i:s") . " " . $contents . "\n";
        fwrite($file, $contents);
        fclose($file);
    }
}
