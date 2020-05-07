<div class="login-box">
  <div class="login-logo">
    <a href="">CPANEL</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión </p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="user" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
      <?php 

        $iniciarSesion = new ControllerSesion();
        $iniciarSesion -> iniciarSesionCtr();

      ?>
     
    </form>
  </div>

</div>
