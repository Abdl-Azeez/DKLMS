<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($myrow[2]==1){$leave="Annual Leave";}
else if ($myrow[2]==2){$leave="Emergency Leave";}
else if ($myrow[2]==3){$leave="Medical Leave";}
else if ($myrow[2]==4){$leave="Replacement Leave";}
else {$leave="$myrow[2]";}

if ($status==1){$status="approved";}
else if($status==4){$status="disapproved";}
//$toAddress = $myrow[3]; //To whom you are sending the mail.
$message   = <<<EOT
    <html>
       <body>
          <h>$leave you applied for as been $status by Admin, kindly log in to the system to view the request details</h>
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
$mail->Subject = "LEAVE ACKNOWLEDGEMENT BY ADMIN"; // Mail subject
$mail->Body    = $message;
$mail->AddAddress($myrow[1]);
if (!$mail->Send()) {
    echo "Action recorded but fail to send to Superior mail";

}
else {
    echo "success";

}
?>
