console.log("ber");

const menuFlash = $(".menu-flash").data("menuflash");
const menuFailed = $(".menu-flash").data("menufailed");
const menuAdded = $(".menu-flash").data("menuadded");
if (menuFlash) {
	Swal.fire({
		title: "Menu",
		text: "Successfully" + menuFlash,
		icon: "success",
		timer: 2500,
	});
}
if (menuAdded) {
	Swal.fire({
		title: "Menu",
		text: "Successfully" + menuAdded,
		icon: "success",
		timer: 2500,
	});
} else if (menuFailed) {
	Swal.fire({
		title: "Menu",
		text: "Menu" + menuFailed,
		icon: "error",
		timer: 2500,
	});
}

const subMenuAdded = $(".menu-flash").data("submenu_added");
const subMenuFailed = $(".menu-flash").data("submenu_failed");
if (subMenuAdded) {
	Swal.fire({
		title: "Submenu",
		text: "Successfully" + subMenuAdded,
		icon: "success",
		timer: 2500,
	});
} else if (subMenuFailed) {
	Swal.fire({
		title: "Submenu",
		text: "Submenu" + subMenuFailed,
		icon: "error",
		timer: 2500,
	});
}

const roleFlash = $(".role-flash").data("roleflash");
const roleAdd = $(".role-flash").data("roleadded");
const roleFailed = $(".role-flash").data("rolefailed");
if (roleFlash) {
	Swal.fire({
		title: "Role",
		text: "Successfully" + roleFlash,
		icon: "success",
		timer: 2500,
	});
}
if (roleAdd) {
	Swal.fire({
		title: "Role",
		text: "Successfully" + roleAdd,
		icon: "success",
		timer: 2500,
	});
} else if (roleFailed) {
	Swal.fire({
		title: "Role",
		text: "Role" + roleFailed,
		icon: "error",
		timer: 2500,
	});
}

// input check

$(document).ready(function(){
	$('.form-check-input').on('click', function(){
		const menuId = $(this).data('menu');
		const roleId = $(this).data('role');
		const url = $(this).data('url');
		$.ajax({
			url: url + 'admin/changeaccess',
			type: 'post',
			data: {
				menuId: menuId,
				roleId: roleId
			},
			success: function(){
				document.location.href = url + 'admin/roleaccess/' + roleId;
			}
		});
	});
});



//delete
$(".delete").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(document).ready(function () {
	const flashdataElement = document.getElementById("flashdata");
	const loginSuccess = flashdataElement.getAttribute("data-login-success");
	const loginError = flashdataElement.getAttribute("data-login-error");

	if (loginSuccess) {
		const Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 2000,
			timerProgressBar: false,
			didOpen: (toast) => {
				toast.onmouseenter = Swal.stopTimer;
				toast.onmouseleave = Swal.resumeTimer;
			},
		});
		Toast.fire({
			icon: "success",
			title: "Signed in successfully",
		}).then((result) => {
			if (result) {
			}
		});
	} else if (loginError) {
		Swal.fire({
			title: "Error",
			text: loginError,
			icon: "error",
		});
	}
});

//image

    $('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
      
    });





// addMenu = () => {
// 	var menuInput = document.getElementById("menu");
// 	var menuError = document.getElementById("menu-error");

// 	if (menuInput.value.trim() === "") {
// 		menuError.textContent = "Menu name is required.";
// 	} else {
// 		menuError.textContent = ""; // Clear the error message

// 	}
// };
// toogleMenu = (button) => {
// 	var add = document.getElementById("addButton");
// 	var edit = document.getElementById("editButton");

// 	if (button === "add") {
// 		add.hidden = false;
// 		edit.hidden = true;
// 	} else {
// 		add.hidden = true;
// 		edit.hidden = false;

// 	}
// };

//menu modal
$(function () {
	$(".btnAdd").on("click", function () {
		$("#menuModalLabel").html("Add Menu");
		$(".modal-footer button[type=submit]").html("Add");
	});
	$(".menuModalEdit").on("click", function () {
		$("#menuModalLabel").html("Edit Menu");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/MENCOBA/menu/editmenu/"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/MENCOBA/menu/getEditMenu/",
			data: { id_menu: id },
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data);

				if (data) {
					$("#id_menu").val(data.id_menu);
					$("#menu").val(data.menu);
				} else {
					console.error("Data is null or undefined");
				}
			},
		});
	});
});

//submenu modal
$(function () {
	$(".btnEdit").on("click", function () {
		$("#submenuModalLabel").html("Add Sub Menu");
		$(".modal-footer button[type=submit]").html("Add");
	});
	$(".subMenuModal").on("click", function () {
		$("#submenuModalLabel").html("Edit Sub Menu");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/MENCOBA/menu/editsubmenu/"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/MENCOBA/menu/getEditSubMenu/",
			data: { id_sub: id },
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data);

				if (data) {
					$("#id_sub").val(data.id_sub); // Sesuaikan dengan id_sub
					$("#title").val(data.title);
					$("#menu_name").val(data.menu_id);
					$("#url").val(data.url);
					$("#icon").val(data.icon);
					$("option[value=" + data.menu_id + "]").attr("selected", "");
					if (data.is_active == 1) {
						$("#active").attr("checked", "");
					} else {
						$("#active").removeAttr("checked", "");
					}
				} else {
					console.error("Data is null or undefined");
				}
			},
		});
	});
});

//role modal
$(function () {
	$(".btnAddRole").on("click", function () {
		$(".roleModalLabel").html("Add Role");
		$(".modal-footer button[type=submit]").html("Add");
	});
	$(".roleModalEdit").on("click", function () {
		$("#roleModalLabel").html("Edit Role");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/MENCOBA/admin/editrole/"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/MENCOBA/admin/geteditrole/",
			data: { id_role: id },
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data);

				if (data) {
					$("#id_role").val(data.id_role);
					$("#role").val(data.role);
				} else {
					console.error("Data is null or undefined");
				}
			},
		});
	});
});
