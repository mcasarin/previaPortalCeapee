<?php require_once('./controller/Register.php'); ?>
<?php
  $Register = new Register();
  $Response = [];
  $active = $Register->active;
  if (isset($_POST) && count($_POST) > 0) $Response = $Register->register($_POST);
?>
<?php require('./nav.php'); ?>
  <main role="main" class="container">
    <div class="container">
      <div class="row justify-content-center mt-5">
        <div class="col-xs-12 col-sm-12 col-md-12 col-xl-4 col-lg-4 center-align center-block">
          <?php if (isset($Response['status']) && !$Response['status']) : ?>
          <br>
          <div class="alert alert-danger" role="alert">
            <span><B>Oops!</B> Verifique qual o problema encontrado no formulário.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" class="text-danger">&times;</span>
            </button>
          </div>
          <?php endif; ?>
          <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin">
            <h4 class="h3 mb-3 font-weight-normal text-center">Registre-se</h4>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputName" class="sr-only">Names</label>
                <input type="text" id="inputName" class="form-control" placeholder="Coloque seu nome completo" name="name" required autofocus value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                <?php if (isset($Response['name']) && !empty($Response['name'])): ?>
                  <small class="text-danger"><?php echo $Response['name']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputEmail" class="sr-only">Email</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Coloque seu e-mail" name="email" required autofocus value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <?php if (isset($Response['email']) && !empty($Response['email'])): ?>
                  <small class="text-danger"><?php echo $Response['email']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12 mt-4">
              <div class="form-group">
                <label for="inputPhone" class="sr-only">Phone Number</label>
                <input type="text" id="inputPhone" class="form-control" placeholder="Coloque seu telefone" name="phone" required autofocus value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>">
                <?php if (isset($Response['phone']) && !empty($Response['phone'])): ?>
                  <small class="text-danger"><?php echo $Response['phone']; ?></small>
                <?php endif; ?>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Senha com no mínimo 7 caracteres" required onchange="passwordCaracters()">

                  <small id="notSeven" class="text-danger"></small>

              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
              <div class="form-group">
                <label for="inputRepeat" class="sr-only">Repeat password</label>
                <input type="password" name="repeatPassword" id="inputRepeat" class="form-control" placeholder="Confirme a senha" required onkeyup="validRepeatEmail()">
                <small class="text-danger" id="notConfirmed"></small>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
              <button id="btnRegister" class="btn btn-md btn-primary btn-block" type="submit" disabled="true">Registro</button>
            </div>
            <p class="mt-5 text-center mb-3 text-muted">&copy; Etwas Informática <?php echo date('Y'); ?></p>
          </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
