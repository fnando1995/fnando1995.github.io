<!-- <?php
$email_address = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !$email_address)
   {
	echo "No arguments Provided!";
	return false;
   }

$name = $_POST['name'];
if ($email_address === FALSE) {
    echo 'Invalid email';
    exit(1);
}
$phone = $_POST['phone'];
$message = $_POST['message'];

if (empty($_POST['_gotcha'])) { // If hidden field was filled out (by spambots) don't send!
    // Create the email and send the message
    $to = 'fnando1995@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Website Contact Form:  $name";
    $email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
    //$headers = "From: $email_address\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    return true;
}
echo "Gotcha, spambot!";
return false;
?> -->

<?php
// contact_form.php (PHP form handler)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the inputs
    $name = htmlspecialchars($_POST['name']);
    $email_address = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Check for empty fields or invalid email
    if (empty($name) || empty($email_address) || empty($phone) || empty($message) || !$email_address) {
        echo "No arguments provided or invalid email!";
        return false;
    }

    // If everything is valid, send the email
    $to = "fnando1995@gmail.com"; // Replace with your email
    $email_subject = "Contact Form: $name";
    $email_body = "You have received a new message from your website contact form.\n\n" .
                  "Name: $name\nEmail: $email_address\nPhone: $phone\nMessage:\n$message";

    $headers = "From: noreply@gmail.com\n"; // Replace with your domain's email
    $headers .= "Reply-To: $email_address";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message successfully sent!";
        return true;
    } else {
        echo "Message delivery failed!";
        return false;
    }
}
?>

