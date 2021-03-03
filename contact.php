<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

// if(!$_POST) exit;

// Email address verification, do not edit.
function isEmail($email) {
	return(preg_match('/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i',$email));
}

if (!defined('PHP_EOL')) define('PHP_EOL', '\r\n');

$first_name     = $_POST['first_name'];
$last_name     = $_POST['last_name'];
$email    = $_POST['email'];
$phone   = $_POST['phone'];
$select_price   = $_POST['select_price'];
$select_service   = $_POST['select_service'];
$subject  = $_POST['subject'];
$comments = $_POST['comments'];
$verify   = $_POST['verify'];

// if(trim($first_name) == '') {
// 	echo '<div class="error_message">Attention! You must enter your name.</div>';
// 	exit();
// }  else if(trim($email) == '') {
// 	echo '<div class="error_message">Attention! Please enter a valid email address.</div>';
// 	exit();
// } else if(!isEmail($email)) {
// 	echo '<div class="error_message">Attention! You have enter an invalid e-mail address, try again.</div>';
// 	exit();
// }

// if(trim($comments) == '') {
// 	echo '<div class="error_message">Attention! Please enter your message.</div>';
// 	exit();
// }

if(get_magic_quotes_gpc()) {
	$comments = stripslashes($comments);
}

$e_subject = 'LC - Inquiry from ' . $first_name . ' ' . $last_name . '!';
$e_body = 'You have been contacted by -' . $first_name . ' ' . $last_name . ' - ' . $email . ' - ' . $phone . PHP_EOL . PHP_EOL;
$e_content = '\'' . $comments .'\'' . PHP_EOL . PHP_EOL;

$msg = wordwrap( $e_body . $e_content, 70 );
// Replace sender@example.com with your 'From' address.
// This address must be verified with Amazon SES.
$sender = 'ashton@newtrostudios.com';
$senderName = 'Louisville Cabinets';

echo $msg;
// Replace recipient@example.com with a 'To' address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'ashton@newtrostudios.com';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'AKIARRXL7UGNQW6QYCVL';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BPqyx9OClh3bdnwh0cw7lESR8Rmnm2UWD2AuayxjGugh';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
// $configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.us-east-2.amazonaws.com';
$port = 587;

// // The subject line of the email
// $subject = 'Amazon SES test (SMTP interface accessed using PHP)';

// // The plain-text body of the email
// $bodyText =  'Email Test\r\nThis email was sent through the
//     Amazon SES SMTP interface using the PHPMailer class.';

// // The HTML-formatted body of the email
// $bodyHtml = '<h1>Email Test</h1>
//     <p>This email was sent through the
//     <a href='https://aws.amazon.com/ses'>Amazon SES</a> SMTP
//     interface using the <a href='https://github.com/PHPMailer/PHPMailer'>
//     PHPMailer</a> class.</p>';

$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender, $senderName);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $e_subject;
    $mail->Body       = $msg;
    $mail->AltBody    = $e_body;
    $mail->Send();
    echo 'Email sent!' , PHP_EOL;
} catch (phpmailerException $e) {
    echo 'An error occurred. {$e->errorMessage()}', PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo 'Email not sent. {$mail->ErrorInfo}', PHP_EOL; //Catch errors from Amazon SES.
}

?>