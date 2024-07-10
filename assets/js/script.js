console.log("ber");

const menuFlash = $(".menu-flash").data("menuflash");
if (menuFlash) {
	Swal.fire({
		title: "Menu",
		text: "Successfully" + menuFlash,
		icon: "success",
		timer: 2500,
	});
}

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

$(function () {
	$(".tombolTambah").on("click", function () {
		$("#formModalLabel").html("Tambah Data Mahasiswa");
		$(".modal-footer button[type=submit]").html("Add");
	});
	$(".tampilModalEdit").on("click", function () {
		$("#formModalLabel").html("Edit Menu");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr("action", "http://localhost/MENCOBA/menu/edit/");

		const id = $(this).data("id"); 
		// console.log(id);

		$.ajax({
			url: "http://localhost/MENCOBA/menu/getEdit/",
			data: { id_menu: id }, 
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data); 
				if (data) {
					$("#id_menu").val(data.id_menu); // Sesuaikan dengan id_menu
					$("#menu").val(data.menu);
				} else {
					console.error("Data is null or undefined");
				}
			},
		});
	});
});
