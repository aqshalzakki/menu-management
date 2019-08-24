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
                                    <h1 class="h4 text-gray-900 mb-4">Reset your password here!</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>

                                <form action="<?= base_url('auth/changePassword'); ?>" method="post" class="user">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password1" id="password1" placeholder="New password..">
                                        <!-- error message -->
                                        <?= form_error('password1', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Repeat password..">
                                        <!-- error message -->
                                        <?= form_error('password2', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                                    </div>
                                    <button name="reset" type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset password 
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>