
  <div class="container">

   <div class="row justify-content-center">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 col-md-8">
      <div class="ard-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form method="post" action="<?= base_url('auth/registration'); ?>" class="user">
                <div class="form-group">
                  <input name="username" type="text" class="form-control form-control-user" placeholder="Username" value="<?= set_value('username'); ?>">
                  <!-- if form error was encountered -->
                  <?= form_error('username','<small class="text-danger pl-2 pt-1">','</small>'); ?>
                </div>

                <div class="form-group">
                  <input name="email" type="text" class="form-control form-control-user"  placeholder="Email Address" value="<?= set_value('email'); ?>">
                  <!-- if form error was encountered -->
                  <?= form_error('email','<small class="text-danger pl-2 pt-1">','</small>'); ?>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input name="password" type="password" class="form-control form-control-user" placeholder="Password">
                    <!-- if form error was encountered -->
                    <?= form_error('password','<small class="text-danger pl-2 pt-1">','</small>'); ?>
                  </div>

                  <div class="col-sm-6">
                    <input name="password2" type="password" class="form-control form-control-user" placeholder="Repeat Password">
                  </div>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  </div>
