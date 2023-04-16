<?php

// //Import PHPMailer classes into the global namespace
// //These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer-master/src/Exception.php';
// require 'PHPMailer-master/src/PHPMailer.php';
// require 'PHPMailer-master/src/SMTP.php';






//   function send_mail($recipient,$subject,$message)
//     {
//         //Create an instance; passing `true` enables exceptions
//         $mail = new PHPMailer(true);

//         try {
//             //Server settings
//             $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//             $mail->isSMTP();                                            //Send using SMTP
//             $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//             $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//             $mail->Username   = 'omareidd22@gmail.com';                     //SMTP username
//             $mail->Password   = 'egvjsbbaknzchxlc';                               //SMTP password
//             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//             $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//             //Recipients
//             $mail->setFrom('omareidd22@gmail.com', 'BMT');
//             $mail->addAddress($recipient, 'Joe User');     //Add a recipient
//             // $mail->addAddress('ellen@example.com');               //Name is optional
//             // $mail->addReplyTo('info@example.com', 'Information');
//             // $mail->addCC('cc@example.com');
//             // $mail->addBCC('bcc@example.com');


//             //Attachments
//             // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//             // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//             //Content
//             $mail->isHTML(true);                                  //Set email format to HTML
//             $mail->Subject = $subject;
//             $mail->Body    = $message;
//             $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//             $mail->send();
//             echo 'Message has been sent';
//         } catch (Exception $e) {
//             echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//         }
//     }














//   use PHPMailer\PHPMailer\PHPMailer;
//   use PHPMailer\PHPMailer\Exception;
//   require 'PHPMailer-master/src/Exception.php';
//   require 'PHPMailer-master/src/PHPMailer.php';
//   require 'PHPMailer-master/src/SMTP.php';


// use this

//   function send_mail($recipient,$subject,$message)
// {

//   $mail = new PHPMailer();
//   $mail->IsSMTP();

//   $mail->SMTPDebug  = 0;  
//   $mail->SMTPAuth   = TRUE;
//   $mail->SMTPSecure = "tls";
//   $mail->Port       = 587;
//   $mail->Host       = "smtp.gmail.com";
//   //$mail->Host       = "smtp.mail.yahoo.com";
//   $mail->Username   = "omareidd22@gmail.com";
//   $mail->Password   = "klmzzmzfvkeidkho";

//   $mail->IsHTML(true);
//   $mail->AddAddress($recipient, "esteemed customer");
//   $mail->SetFrom("omareidd22@gmail.com", "ducks");
//   //$mail->AddReplyTo("reply-to-email", "reply-to-name");
//   //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
//   $mail->Subject = $subject;
//   $content = $message;

//   $mail->MsgHTML($content); 
//   if(!$mail->Send()) {
//     //echo "Error while sending Email.";
//     //echo "<pre>";
//     //var_dump($mail);
//     return false;
//   } else {
//     //echo "Email sent successfully";
//     return true;
//   }

// }
 





//   function send_mail($recipient, $subject, $message) {
//       // Create a new PHPMailer instance
//       $mail = new PHPMailer;
  
//       // Set the mailer to use SMTP
//       $mail->isSMTP();
  
//       // Set the hostname of the mail server
//       $mail->Host = 'smtp.example.com';
  
//       // Set the SMTP port number
//       $mail->Port = 465;
  
//       // Set the encryption system to use - ssl (deprecated) or tls
//       $mail->SMTPSecure = 'ssl';
  
//       // Set the username and password for the SMTP account
//       $mail->Username = 'omareidd22@gmail.com';
//       $mail->Password = 'klmzzmzfvkeidkho';
  
//       // Set the sender's email address and name
//       $mail->SetFrom("omareidd22@gmail.com", "Ducks Row");
        
//       // Set the recipient's email address and name
//       $mail->addAddress($recipient);
  
//       // Set the subject and body of the email
//       $mail->Subject = $subject;
//       $mail->Body    = $message;
  
//       // Send the email
//       if(!$mail->send()) {
//           // If the email failed to send, return an error message
//           return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
//       } else {
//           // If the email was sent successfully, return a success message
//           return 'Message has been sent';
//       }
//   }
//   






?>