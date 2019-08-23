    <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
          
          <div class="row">
          	<div class="col-lg">
				<?php if (validation_errors()) : ?>
					<div class="alert alert-danger" role="alert">
						<?= validation_errors(); ?>
					</div>
				<?php endif; ?>

				<?= $this->session->flashdata('message'); ?>
				
				<a href="" class="btn btn-primary mb-3 submenu-add" data-toggle="modal" data-target="#newSubmenuModal">Add New Submenu</a>
          		<table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Title</th>
				      <th scope="col">Menu</th>
				      <th scope="col">Url</th>
				      <th scope="col">Icon</th>
				      <th scope="col">Active</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  	  <?php $i = 1; ?>
					  <?php foreach($subMenu as $sm) : ?>
					    <tr>
					      <th scope="row"><?= $i++; ?></th>
					      <td><?= $sm['title']; ?></td>
					      <td><?= $sm['menu']; ?></td>
					      <td><?= $sm['url']; ?></td>
					      <td><?= $sm['icon']; ?></td>
					      <td><?= $sm['is_active']; ?></td>
					      <td>
							<a href="" data-id="<?= $sm['id']; ?>" class="badge badge-success submenu-edit" data-toggle="modal" data-target="#newSubmenuModal">Edit</a>
							<a onclick="return confirm('Delete this Submenu?')" href="<?= base_url('menu/delete/submenu/').$sm['id']; ?>" class="badge badge-danger">Delete</a>
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

<div class="modal fade" id="newSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubmenuModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header submenu-header">
        <h5 class="modal-title submenu-title" id="newSubmenuModal">Add new Submenu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="submenu-form" action="<?= base_url('menu/subMenu'); ?>" method="post">
      		<!-- HIDDEN ID -->
      		<input class="id" type="hidden" name="id" value="">
		      <div class="modal-body submenu-body">
				<div class="form-group">
		        	<input class="form-control title" type="text" id="title" name="title" placeholder="Submenu title">
				</div>

				<div class="form-group">
			      	<select name="menu_id" id="menu_id" class="form-control menu">
			      		<option value="">Select Menu</option>
			      		<?php foreach($menu as $m) : ?>
			      			<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
			      		<?php endforeach; ?>
			      	</select>
			     </div>

			     <div class="form-group">
		        	<input class="form-control url" type="text" id="url" name="url" placeholder="Submenu url">
				 </div>
				 
				 <div class="form-group">
		        	<input class="form-control icon" type="text" id="icon" name="icon" placeholder="Submenu icon">
				 </div>
				 
				 <div class="form-group">
				 	<div class="form-check">
					  <input class="form-check-input is-active" type="checkbox" value="1" checked name="is_active" id="is_active">
					  <label class="form-check-label" for="is_active">
					    Active?
					  </label>
					</div>
				 </div>

		      </div>
	      <div class="modal-footer submenu-footer">
	      	<button type="submit" class="btn btn-primary">Add</button>
	  </form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	      </div>
    </div>
  </div>
</div>