<?php
  require_once(__dir__ . '/Controller.php');
  require_once('./Model/RegisterModel.php');
  class Register extends Controller {

    public $active = 'Register'; //for highlighting the active link...
    private $registerModel;

    /**
      * @param null|void
      * @return null|void
      * @desc Checks if the user session is set and creates a new instance of the RegisterModel...
    **/
    public function __construct()
    {
      if (isset($_SESSION['auth_status'])) header("Location: dashboard.php");
      $this->registerModel = new RegisterModel();
    }

    /**
      * @param array
      * @return array|boolean
      * @desc Verifies, Creates, and returns a user by calling the register method on the RegisterModel...
    **/
    public function register(array $data)
    {
      $name = stripcslashes(strip_tags($data['name']));
      $email = stripcslashes(strip_tags($data['email']));
      $phone = stripcslashes(strip_tags($data['phone']));
      $password = stripcslashes(strip_tags($data['password']));

      $EmailStatus = $this->registerModel->fetchUser($email)['status'];

      $Error = array(
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'status' => false
      );

      if (preg_match('/[^A-Za-z\s]/', $name)) {
        $Error['name'] = 'Somente letras são permitidas no nome.';
        return $Error;
      }

      if (!empty($EmailStatus)) {
        $Error['email'] = 'Desculpe. Esse e-mail já foi usado.';
        return $Error;
      }

      if (preg_match('/[^0-9_]/', $phone)) {
        $Error['phone'] = 'Por favor, utilize um número válido. Somente números e com o formato \'código de área\'+\'número de telefone\'.';
        return $Error;
      }

      if (strlen($password) < 7) {
        $Error['password'] = 'Por favor, utilize uma senha forte. Precisa de mais de 7 caracteres.';
        return $Error;
      }

      $Payload = array(
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => password_hash($password, PASSWORD_BCRYPT)
      );

      $Response = $this->registerModel->createUser($Payload);

      $Data = $this->registerModel->fetchUser($email)['data'];
      unset($Data['password']); //Makes a whole lot of sense to get rid of any critical information...

      if (!$Response['status']) {
        $Response['status'] = 'Desculpe. Houve um erro inesperado e precisa reiniciar o processo de cadastro, por gentileza.';
        return $Response;
      }

      $_SESSION['data'] = $Data;
      $_SESSION['auth_status'] = true;
      header("Location: dashboard.php");
      return true;
    }
  }
 ?>
