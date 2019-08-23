    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <div class="row">
          	<div class="col-lg-6">
				
				<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
				
				<?= $this->session->flashdata('message'); ?>
				
				<a href="" class="btn btn-primary mb-3 menu-add" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Menu</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	  <?php $i = 1; ?>
					  <?php foreach($menu as $m) : ?>
					    <tr>
					      <th scope="row"><?= $i++; ?></th>
					      <td><?= $m['menu']; ?></td>
					      <td>
							<a href="" data-id="<?= $m['id']; ?>" class="badge badge-success menu-edit" data-toggle="modal" data-target="#newMenuModal">Edit</a>
							<a onclick="return confirm('Delete this menu?')" href="<?= base_url('menu/delete/menu/').$m['id']; ?>" class="badge badge-danger">Delete</a>
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

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header menu-header">
        <h5 class="modal-title menu-title" id="newMenuModal">Add new menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="menu-form" action="<?= base_url('menu'); ?>" method="post">
      		<!-- hidden id -->
      		<input type="hidden" name="id" class="id">
		      <div class="modal-body menu-body">
		        <input class="form-control menu-input" type="text" id="menu" name="menu" placeholder="Menu name">
		      </div>
	      <div class="modal-footer menu-footer">
	      	<button type="submit" class="btn btn-primary">Add</button>
	  </form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	      </div>
    </div>
  </div>
</div>