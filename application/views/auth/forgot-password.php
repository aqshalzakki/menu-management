<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-10">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot your password?</h1>
                                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form action="<?= base_url('auth/forgotPassword'); ?>" method="post" class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                        <!-- error message -->
                                        <?= form_error('email', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                                    </div>
                                    <button name="forgot" type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center"> <a class="small" href="<?= base_url('auth'); ?>">Back to login page</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>