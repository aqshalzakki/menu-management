    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

        <div class="row">
            <div class="col-lg-8">

                <?= $this->session->flashdata('message'); ?>

                <?= form_open_multipart('user/changepassword'); ?>

                <div class="form-group row">
                    <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-8">
                        <input name="current_password" autofocus type="password" class="form-control" id="current_password">
                        <!-- error message -->
                        <?= form_error('current_password', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-8">
                        <input autocomplete="off" name="new_password" type="password" class="form-control" id="new_password">
                        <!-- error message -->
                        <?= form_error('new_password', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input autocomplete="off" name="confirm_password" type="password" class="form-control" id="confirm_password">
                        <!-- error message -->
                        <?= form_error('confirm_password', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Change password</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->