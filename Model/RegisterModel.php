 <?php
 /*
 * Fonte:
 * https://www.webslesson.info/2017/12/php-registration-script-with-email-confirmation.html (Adaptado)
 * https://github.com/PHPMailer/PHPMailer (Biblioteca)
 * abr22
 */
  require_once(__dir__ . '/Db.php');
  require_once('./config.php');

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require './PHPMailer/src/Exception.php';
  require './PHPMailer/src/PHPMailer.php';
  require './PHPMailer/src/SMTP.php';

  class RegisterModel extends Db {

    /**
      * @param array
      * @return array
      * @desc Creates and returns a user record....
    **/
    public function createUser(array $user) :array
    {
      $this->query("INSERT INTO `db_user` (name, email, phone_no, password, status, activation_code) VALUES (:name, :email, :phone_no, :password, :status, :activation_code)");
      $this->bind('name', $user['name']);
      $this->bind('email', $user['email']);
      $this->bind('phone_no', $user['phone']);
      $this->bind('password', $user['password']);
      $this->bind('status',$user['status']);
      $this->bind('activation_code', $user['activation_code']);

      if ($this->execute()) {
        
        // PHPMailer
        $base_url = BASE_URL;
        $mail_body = "
        <p>Olá, ".$user['name'].",</p>
        <p>Obrigado pelo seu cadastro. Utilize o link abaixo para ativar sua conta.</p>
        <p>".$base_url."email_verification.php?email=".$user['email']."&activation_code=".$user['activation_code']."</p>
        <p>Caso tenha alguma restrição, copie e cole o endereço no navegador.</p>
        <p>Nossos agradecimentos.</p>
        <p>CEAP-EE, Centro de Apoio à Escola de Enfermagem</p>";
        
        $mail = new PHPMailer;
        $mail->setLanguage('pt-br','./PHPMailer/language/');
        $mail->IsSMTP();        //Sets Mailer to send message using SMTP
        $mail->Host = 'mail.ceapee.com.br';  //Sets the SMTP hosts of your Email hosting, this for Godaddy
        $mail->Port = '465';        //Sets the default SMTP server port
        $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
        $mail->Username = 'naoresponda@ceapee.com.br';     //Sets SMTP username
        $mail->Password = 'N@pol3ao01';     //Sets SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->setFrom('naoresponda@ceapee.com.br','CEAP-EE USP');   //Sets the From email address for the message
        $mail->AddAddress($user['email'], $user['name']);  //Adds a "To" address   
        $mail->IsHTML(true);       //Sets message type to HTML    
        $mail->Subject = 'Checagem de e-mail - Cadastro';   //Sets the Subject of the message
        $mail->Body = $mail_body;       //An HTML or plain text message body
        if($mail->send()){
          header("Location: verifiedpending.php");
        } else {
          echo "Não foi enviado e-mail de ativação!";
        }
        // PHPMailer

        // Com esse retorno o cadastro não tem validação por email
        // $Response = array(
        //   'status' => false
        // );
        // return $Response;
        
        
      } else {
        $Response = array(
          'status' => false
        );
        return $Response;
      }
    }

    /**
      * @param string
      * @return array
      * @desc Returns a user record based on the method parameter....
    **/
    public function fetchUser(string $email) :array
    {
      $this->query("SELECT * FROM `db_user` WHERE `email` = :email");
      $this->bind('email', $email);
      $this->execute();

      $User = $this->fetch();
      if (!empty($User)) {
        $Response = array(
          'status' => true,
          'data' => $User
        );
        return $Response;
      }
      return array(
        'status' => false,
        'data' => []
      );
    }
    // Validação de email
    public function checkMail(array $email) :array
    {
      $this->query("UPDATE `db_user` SET `status`='1' WHERE `email` = :email AND `activation_code` = :activation_code");
      $this->bind('email',$email['email']);
      $this->bind('activation_code',$email['activation_code']);
      $this->execute();

      if($this->execute()){
        $Response = array(
          'status' => true,
        );
        return $Response;
      } else {
        $Response = array(
          'status' => false,
        );
        return $Response;
      }
    }
  }
 ?>
