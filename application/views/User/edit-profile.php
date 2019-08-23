    <!-- Begin Page Content -->
    <div class="container-fluid">

    	<!-- Page Heading -->
    	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


	<div class="row">
    		<div class="col-lg-8">
				
				<?= $this->session->flashdata('message'); ?>
				
    			<?= form_open_multipart('user/edit'); ?>

    			<div class="form-group row">
    				<label for="email" class="col-sm-2 col-form-label">Email</label>
    				<div class="col-sm-10">
    					<input name="email" type="text" class="form-control" id="email" value="<?= $user['email']; ?>" readonly>
    				</div>
    			</div>

    			<div class="form-group row">
    				<label for="username" class="col-sm-2 col-form-label">Full name</label>
    				<div class="col-sm-10">
    					<input autocomplete="off" autofocus name="username" type="text" class="form-control" id="username" value="<?= $user['username']; ?>">
    					<!-- error message -->
    					<?= form_error('username', '<small class="text-danger pl-2 pt-1">', '</small>'); ?>
    				</div>
    			</div>

    			<div class="form-group row">
    				<div class="col-sm-2">Picture</div>
    				<div class="col-sm-10">
    					<div class="row">
    						<div class="col-sm-3">
    							<img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
    						</div>
    						<div class="col-sm-9">
    							<div class="custom-file">
    								<input type="file" class="custom-file-input" name="image" id="image">
    								<label class="custom-file-label" for="image">Choose file</label>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>

    			<div class="form-group row justify-content-end">
    				<div class="col-sm-10">
    					<button type="submit" class="btn btn-primary">Save changes</button>
    				</div>
    			</div>
    			</form>
    		</div>
    	</div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->