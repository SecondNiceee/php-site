<?php 
namespace app\controllers;
use shop\App;
use PHPMailer\PHPMailer\PHPMailer;

class MailController extends AppController
{
   public function collAction()
   {
      if(!empty($_POST)) {
         if($_POST['name'] != '' && $_POST['phone'] != '') {
            $mail = new PHPMailer(true);
           
            try {
               $mail->CharSet = "UTF-8";
               $mail->setFrom('admin@potokmsk.ru', 'potokmsk.ru');
               $mail->addAddress(App::$app->getProperty('admin_email'));
               $mail->isHTML(true);
               $mail->Subject = "Новая заявка на звонок";
               ob_start();
               require \APP . "/views/mail/mail_call.php";
               $body = ob_get_clean();
               $mail->Body = $body;
               $mail->send();
               return true;
            } catch (Exception $e) {
               return false;
            }
         }
     }
   }  
}