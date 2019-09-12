<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//$toAddress = $myrow[3]; //To whom you are sending the mail.
$message   = <<<EOT
    <html>
       <body>
          <h>A leave has been recommended by a superior, kindly log in to the system to acknowledge the request</h>
       </body>
    </html>
EOT;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth    = true;
$mail->Host        = "smtp.gmail.com";
$mail->Port        = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->IsHTML(true);
$mail->Username = "AbdulazeezFYP@gmail.com"; // your gmail address
$mail->Password = "Adediran"; // password
$mail->ClearReplyTos();
$mail->AddReplyTo('xxxx@xxxmail.com', 'Reply to name');
$mail->SetFrom('xxxx@nomail.com', 'LEAVE MANAGEMENT');
$mail->Subject = "SUPERIOR REQUEST"; // Mail subject
$mail->Body    = $message;
$mail->AddAddress($myrow[3]);
if (!$mail->Send()) {
    echo "Action recorded but fail to send to HR mail";

}
else {
    echo "success";

}
?>
