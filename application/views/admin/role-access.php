    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <div class="row">
          	<div class="col-lg-6">
          		
					<?= $this->session->flashdata('message'); ?>

				<h5 class="mb-3">Role : <?= $role['role']; ?></h5>

          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Menu</th>
				      <th scope="col">Access</th>
				    </tr>
				  </thead>
				  <tbody>
				  	  <?php $i = 1; ?>
					  <?php foreach($menu as $m) : ?>
					    <tr>
					      <th scope="row"><?= $i++; ?></th>
					      <td><?= $m['menu']; ?></td>
					      <td>
					      	<div class="form-check">
					      		<input data-role = "<?= $role['id']; ?>" data-menu = "<?= $m['id']; ?>"
					      		type="checkbox" 
					      		class="form-check-input check-access" 
					      		<?= check_access($role['id'], $m['id']); ?>
					      		>
					      	</div>
					      </td>
					    </tr>
					  <?php endforeach; ?>
			  </tbody>
				</table>

          	</div>
          </div>
			<a class="ml-2" href="<?= base_url('admin/role'); ?>">&laquo Back</a>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->