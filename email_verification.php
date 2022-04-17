<?php

require_once('./controller/Register.php');

$Register = new Register();

if (isset($_REQUEST) && count($_REQUEST) > 0){
    $email = $_REQUEST['email'];
    $activation_code = $_REQUEST['activation_code'];
    $check = array(
        'email' => $email,
        'activation_code' => $activation_code
    );

    $Response = $Register->validMail($check);

$message = '';

if(isset($Response)){

     $message = '<label class="text-success">Seu cadastro foi ativado com sucesso <br />Você pode logar por aqui - <a href="index.php">Login</a></label>';
    }

    $message = '<label class="text-info">Seu e-mail foi validado.</label>';

 } else {
    $message = '<label class="text-danger">Link inválido.</label>';
 }

?>
<!DOCTYPE html>
<html>
 <head>
  <title>Verificação de e-mail</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  
  <div class="container">
   <h1 align="center">Verificação por e-mail.</h1>
  
   <h3><?php echo $message; ?></h3>
   
  </div>
 
 </body>
 
</html>