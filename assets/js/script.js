console.log('ber');


$(document).ready(function() {
    const flashdataElement = document.getElementById('flashdata');
    const loginSuccess = flashdataElement.getAttribute('data-login-success');
    const loginError = flashdataElement.getAttribute('data-login-error');

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
            }
          });
          Toast.fire({
            icon: "success",
            title: "Signed in successfully"
          }).then((result) => {
            if(result){
            }
          })
    } 
    else if (loginError) {
        Swal.fire({
            title: 'Error',
            text: loginError,
            icon: 'error',
        });
    }
});


