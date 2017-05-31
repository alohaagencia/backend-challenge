<?php
namespace Agenda\Plugins;

use Phalcon\Mvc\User\Plugin;
use PHPMailer;

class Mail extends Plugin{

  protected $mail;

  public function __construct() {
    $config = $this->getDI()->get('config');
    
    $this->mail = new PHPMailer();
    $this->mail->isSMTP();
    $this->mail->Host =     $config->mail->smtp->server;
    $this->mail->Username = $config->mail->smtp->username;
    $this->mail->Password = $config->mail->smtp->password;
    $this->mail->SMTPAuth = $config->mail->smtp->auth;
    $this->mail->SMTPSecure = $config->mail->smtp->secure;
    $this->mail->Port = $config->mail->smtp->port;

    $this->mail->From = $config->mail->fromEmail;
    $this->mail->FromName = $config->mail->fromName;    
    $this->mail->CharSet  = $config->mail->charset;
    //$this->mail->SMTPDebug = 4;
    
  } 

  
  public function send($address, $name = "", $subject, $msg){
    $emails = explode(',', $address);
    if (count($emails) > 1) {
      foreach ($emails as $key => $mail) {
        $this->mail->addAddress($mail, $name);
      }
    } else {
      $this->mail->addAddress($emails[0], $name);
    }

    $this->mail->isHTML(true);
    $this->mail->Subject = $subject;

    $template = '<!DOCTYPE HTML PUBLIC \'-//W3C//DTD HTML 4.01 Transitional//EN\' \'http://www.w3.org/TR/html4/loose.dtd\'>
      <html>
        <head>
          <title>' . $this->mail->Subject . '</title>
          <meta http-equiv=\'Content-Type\' content=\'text/html; charset=utf-8\'>
        </head>
        <body style="background: #EEE; padding-top: 30px">
          <center>
            <div style="font-family:Helvetica Neue,Helvetica,Arial; color: #333; font-size: 14px; min-width: 600px; max-width: 800px;">
              <div style="padding: 0 0 10px 0; font-family:Helvetica Neue,Helvetica,Arial; background: #FFF;">
                <div style="background: #FFF; height: 30px; width: 100%"></div>
                <div style="width: 100%; clear: both;">' . $msg . '</div>
                <br>
              </div>
            </div>
            <br>
          <center>
        </body>
      </html>';

    
    $this->mail->Body = $template;
    $this->mail->AltBody = strip_tags($msg);    
    return $this->mail->send();
  }
  
  public function getError() {
    return $this->mail->ErrorInfo;
  }
    
}

?>
