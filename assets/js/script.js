

console.log("ber");

const menuFlash = $('.menu-flash').data('menuflash')
if(menuFlash){
  Swal.fire({
    title: "Menu",
    text: "Successfully" + menuFlash,
    icon: "success",
	timer: 2500
	
  })
}
$('.delete').on('click', function(e){
	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!"
	}).then((result) => {
		if(result.value) {
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
