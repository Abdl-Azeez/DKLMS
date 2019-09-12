<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($leaveType==1){$leave="Annual Leave";}
else if ($leaveType==2){$leave="Emergency Leave";}
else if ($leaveType==3){$leave="Medical Leave";}
else if ($leaveType==4){$leave="Replacement Leave";}
else {$leave="$leaveType";}

$toAddress = "$myrow[3]"; //To whom you are sending the mail.
$message   = <<<EOT
    <html>
       <body>
          <h>$StaffName has applied for $leave, kindly log in to the system to acknowledge the request</h>
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
$mail->Subject = "STAFF LEAVE REQUEST"; // Mail subject
$mail->Body    = $message;
$mail->AddAddress($toAddress);
if (!$mail->Send()) {
    echo "Request sent but fail to send to superior mail";

}
else {
    echo "success";

}
?>
