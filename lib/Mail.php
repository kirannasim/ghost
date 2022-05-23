<?php
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';

// Import PHPMailer classes into the global namespace.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require __DIR__ . '/../vendor/aws-sdk-php/autoload.php';

class Mail {
    protected $usernameSmtp;
    protected $passwordSmtp;
    protected $host;
    protected $port;
    protected $configurationSet;

    function __construct() {
        // Replace smtp_username with your Amazon SES SMTP user name.
        $this->usernameSmtp = 'AKIA3STHE3DVDNVOPUEK';

        // Replace smtp_password with your Amazon SES SMTP password.
        $this->passwordSmtp = 'BPC6mSyq5lBhR+YlP1ccxqgMPBNu07R2RxpodsPwydbq';

        // Specify a configuration set. If you do not want to use a configuration
        // set, comment or remove the next line.
        // $this->configurationSet = 'ConfigSet';

        // If you're using Amazon SES in a region other than US West (Oregon),
        // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
        // endpoint in the appropriate region.
        $this->host = 'email-smtp.us-east-1.amazonaws.com';
        $this->port = 465;
    }

    public function sendMail( $subject, $body, $sender, $senderName, $recipient ) {
        $mail = new PHPMailer(true); 

        try {
            // Specify the SMTP settings.
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->setFrom( $sender, $senderName );
            $mail->Username   = $this->usernameSmtp;
            $mail->Password   = $this->passwordSmtp;
            $mail->Host       = $this->host;
            $mail->Port       = $this->port;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'tls';
            // $mail->addCustomHeader( 'X-SES-CONFIGURATION-SET', $this->configurationSet );

            // Specify the message recipients.
            $mail->addAddress( $recipient );
            // You can also add CC, BCC, and additional To recipients here.

            // The plain-text body of the email
            $bodyText =  "Email Test\r\nThis email was sent through the
            Amazon SES SMTP interface using the PHPMailer class.";

            // The HTML-formatted body of the email
            $bodyHtml = '<h1>Email Test</h1>
            <p>This email was sent through the
            <a href="https://aws.amazon.com/ses">Amazon SES</a> SMTP
            interface using the <a href="https://github.com/PHPMailer/PHPMailer">
            PHPMailer</a> class.</p>';

            // Specify the content of the message.
            $mail->isHTML(true);
            $mail->Subject    = $subject;
            $mail->Body       = $bodyHtml;
            $mail->AltBody    = $bodyText;
            $mail->Send();

            return array(
                'status'    => 'success',
                'message'   => 'Email sent successfully!'
            );
        } catch (phpmailerException $e) {
            return array(
                'status'    => 'error',
                'message'   => 'An error occurred. ' . $e->errorMessage()
            );            
        } catch (Exception $e) {
            return array(
                'status'    => 'error',
                'message'   => 'Email not sent. ' . $mail->ErrorInfo
            );
        }
    }
}

?>