use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class user extends ControllerBase
{
    public function register()
    {
        // ...
        $result = $user->insert($fullName, $email, $dob, $address, $password, $provinceId, $districtId, $wardId);
        if ($result) {
            $this->sendConfirmationEmail($email);
            $this->redirect("user", "confirm", ["email" => $email]);
        } else {
            // ...
        }
    }

    private function sendConfirmationEmail($email)
    {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'anthonynkbq@gmail.com'; // SMTP username
            $mail->Password = '0362629269'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('your_email@gmail.com', 'Your Name');
            $mail->addAddress($email); // Add a recipient

            // Content
            $code = mt_rand(100000, 999999); // Generate a random code
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Confirmation Code';
            $mail->Body = 'Your confirmation code is: ' . $code;

            $mail->send();
            $_SESSION['confirmation_code'] = $code;
        } catch (Exception $e) {
            // ...
        }
    }

    // ...
}
