    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <div class="row">
          	<div class="col-lg-6">
				
				<?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
				
				<?= $this->session->flashdata('message'); ?>
				
				<a href="" class="btn btn-primary mb-3 role-add" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Role</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	  <?php $i = 1; ?>
					  <?php foreach($role as $r) : ?>
					    <tr>
					      <th scope="row"><?= $i++; ?></th>
					      <td><?= $r['role']; ?></td>
					      <td>
					      	<a href="<?= base_url('admin/roleaccess/').$r['id']; ?>" class="badge badge-warning">Access</a>
							<a href="" data-id="<?= $r['id']; ?>" class="badge badge-success role-edit" data-toggle="modal" data-target="#newRoleModal">Edit</a>
							<a onclick="return confirm('Delete this role?')" href="<?= base_url('admin/delete/').$r['id']; ?>" class="badge badge-danger">Delete</a>
					      </td>
					    </tr>
					  <?php endforeach; ?>
			  </tbody>
				</table>

          	</div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- MODAL -->

<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header role-header">
        <h5 class="modal-title role-title" id="newRoleModal">Add new role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="role-form" action="<?= base_url('admin/role'); ?>" method="post">
      		<!-- hidden id -->
      		<input class="hidden" type="hidden" value="" name="id">
		      <div class="modal-body role-body">
		        <input class="form-control role" type="text" id="role" name="role" placeholder="Role name">
		      </div>
	      <div class="modal-footer role-footer">
	      	<button type="submit" class="btn btn-primary">Add</button>
	  </form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	      </div>
    </div>
  </div>
</div>