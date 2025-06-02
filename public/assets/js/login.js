$(document).ready(function(){

    $('#loginForm').on('submit' , function(e){
        e.preventDefault();
        let isValid = true;
        let form = this; 

        // Initialize validation variables
        let emailValidation, emailMandatory, passwordMandatory;

        // Clear previous errors
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');

        // Email validation
        emailMandatory = velovalidation.checkMandatory($('#email'));
        if(emailMandatory !== true){
            isValid = false; 
            $('#email').addClass('is-invalid'); 
            $('#email_error').text(emailMandatory);
        } else {
            emailValidation = velovalidation.checkEmail($('#email'));
            if(emailValidation !== true){
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email_error').text(emailValidation);
            }
        }

        // Password validation
        passwordMandatory = velovalidation.checkMandatory($('#password'));
        if(passwordMandatory !== true){
            isValid = false;
            $('#password').addClass('is-invalid');
            $('#password_error').text(passwordMandatory);
        }

        // If validation passes, submit the form
        if(isValid){
            form.submit();
        }
    });

    // Real-time validation on input change
    $('input').on('input change', function() {
        $(this).removeClass('is-invalid');
        $('#' + $(this).attr('id') + '_error').text('');
    });


});