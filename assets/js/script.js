$(document).ready(function(){
	console.log('ok');
	
	const baseUrl = 'http://localhost/sb-admin/';
	
	// MENU EDIT
	$('.menu-add').on('click', function(){
		$('.menu-title').html('Add Menu')
		$('.menu-footer button[type=submit]').html('Add')
		$('.menu-footer button[type=submit]').attr('class', 'btn btn-primary')
		$('.menu-form').attr('action', baseUrl + 'menu')

		$('.menu-input').val('')
	})

	$('.menu-edit').on('click', function(){
		$('.menu-title').html('Edit Menu')
		$('.menu-footer button[type=submit]').html('Edit')
		$('.menu-footer button[type=submit]').attr('class', 'btn btn-success')
		$('.menu-form').attr('action', baseUrl + 'menu/editMenu')

		const id = $(this).data('id')

		// YANG INI GAK JALAN JALAN LAH AJAXNYA ASW
		// run ajax
		$.ajax({
			url : baseUrl + 'menu/getMenuEdit',
			data : {id : id},
			method : 'post',
			dataType : 'json',

			success : function(data){
				console.log(data);
				$('.menu-form .id').val(data.id)
				$('.menu-input').val(data.menu)
			}
		})
	})


	// SUBMENU EDIT
	$('.submenu-add').on('click', function(){
		$('.submenu-title').html('Add Submenu')
		$('.submenu-footer button[type=submit]').html('Add')
		$('.submenu-footer button[type=submit]').attr('class', 'btn btn-primary')
		$('.submenu-form').attr('action', baseUrl + 'menu/subMenu')

		$('.id').val('')
		$('.title').val('')
		$('.menu').val('')
		$('.url').val('')
		$('.icon').val('')
		$('.is-active').val('1')
	})

	$('.submenu-edit').on('click', function(){
		$('.submenu-title').html('Edit Submenu')
		$('.submenu-footer button[type=submit]').html('Edit')
		$('.submenu-footer button[type=submit]').attr('class', 'btn btn-success')
		$('.submenu-form').attr('action', baseUrl + 'menu/editSubmenu')

		const id = $(this).data('id')
		// run ajax
		$.ajax({
			url : baseUrl + 'menu/getSubmenuEdit',
			method : 'post',
			data : {id : id},
			dataType : 'json',

			success : function(data){
				$('.id').val(data.id)
				$('.title').val(data.title)
				$('.menu').val(data.menu_id)
				$('.url').val(data.url)
				$('.icon').val(data.icon)
				$('.is-active').val(data.is_active)
			}
		})
	})

	// ROLE SECTION
	$('.role-add').on('click', function(){
		$('.role-title').html('Add New role')
		$('.role-footer button[type=submit]').html('Add')
		$('.role-footer button[type=submit]').attr('class', 'btn btn-primary')
		$('.role-form').attr('action', baseUrl + 'admin/role')

		$('.hidden').val('')
		$('.role').val('')			
	})

	$('.role-edit').on('click', function(){
		$('.role-title').html('Edit role')
		$('.role-footer button[type=submit]').html('Edit')
		$('.role-footer button[type=submit]').attr('class', 'btn btn-success')
		$('.role-form').attr('action', baseUrl + 'admin/edit')
 
		const id = $(this).data('id')

		// run ajax
		$.ajax({
			url : baseUrl + 'admin/getRoleEdit',
			method : 'post',
			data : {id : id},
			dataType : 'json',

			success : function(data){
				$('.hidden').val(data.id)
				$('.role').val(data.role)
			}
		})
	})

	// CHECK ACCESS SECTION
	$('.check-access').on('click', function(){
		const roleId = $(this).data('role');
		const menuId = $(this).data('menu');

		// run ajax
		$.ajax({
			data : {
				role_id : roleId,
				menu_id : menuId
			},
			url : baseUrl + 'admin/changeaccess',
			method : 'post',
			success : function(){
				document.location.href = baseUrl + 'admin/roleaccess/' + roleId
			}
		})
	})

	// EDIT PROFILE / IMAGE
	$('.custom-file-input').on('change', function(){
		let filename = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(filename)
	})
})