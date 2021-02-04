$(document).ready(function() {

  
    $("#changepassword-form").ajaxForm({
        beforeSend: function() {
            $("#waiting-saving").html(
                ' <div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
            );
        },

        success: function(data) {
            if (data == 5) {
                $("#waiting-saving").html("");
                toastr.error('New password and Confirm password does not match !!');
                $("#changepassworsms").html(
                    '<p class="text-danger">New password and Confirm password does not match !!</p>'
                );
            }
            if (data == 4) {
                $("#waiting-saving").html("");
                toastr.error('Wrong current password !!');
                $("#changepassworsms").html(
                    '<p class="text-danger">Wrong current password !!</p>'
                );
            }
            if (data == 1) {
                $("#changepassword-form")[0].reset();
                toastr.success('Password changed successfully !!');
                $("#waiting-saving").html("");
                $("#changepassworsms").html(
                    '<p class="text-success">Password changed successfully !!</p>'
                );
            }
        }
    });


});

