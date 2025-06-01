$(document).ready(function() {
    // Form validation
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        let form = this;
        
        // Initialize validation variables
        let nameValidation, emailValidation, emailMandatory,
            passwordValidation, passwordMandatory;
        
        // Clear previous errors
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');

        // Name validation
        nameValidation = velovalidation.checkMandatory($('#name'));
        if (nameValidation !== true) {
            isValid = false;
            $('#name').addClass('is-invalid');
            $('#name_error').text(nameValidation);
        }

        // Email validation - first check mandatory, then format
        emailMandatory = velovalidation.checkMandatory($('#email'));
        if (emailMandatory !== true) {
            isValid = false;
            $('#email').addClass('is-invalid');
            $('#email_error').text(emailMandatory);
        } else {
            emailValidation = velovalidation.checkEmail($('#email'));
            if (emailValidation !== true) {
                isValid = false;
                $('#email').addClass('is-invalid');
                $('#email_error').text(emailValidation);
            }
        }

        // Password validation - first check mandatory, then requirements
        passwordMandatory = velovalidation.checkMandatory($('#password'));
        if (passwordMandatory !== true) {
            isValid = false;
            $('#password').addClass('is-invalid');
            $('#password_error').text(passwordMandatory);
        } else {
            passwordValidation = velovalidation.checkPassword($('#password'));
            if (passwordValidation !== true) {
                isValid = false;
                $('#password').addClass('is-invalid');
                $('#password_error').text(passwordValidation);
            }
        }

        // Confirm Password validation
        if ($('#password').val() !== $('#password_confirmation').val()) {
            isValid = false;
            $('#password_confirmation').addClass('is-invalid');
            $('#password_confirmation_error').text('Passwords do not match');
        }

        // Debug validation results
        console.log('Validation Results:', {
            name: nameValidation || 'Not validated',
            email: {
                mandatory: emailMandatory || 'Not checked',
                format: emailValidation || 'Not validated'
            },
            password: {
                mandatory: passwordMandatory || 'Not checked',
                requirements: passwordValidation || 'Not validated'
            },
            isValid: isValid
        });

        // Submit form if valid
        if (isValid) {
            form.submit(); // Use the stored form reference
        }
    });

    // Real-time validation on input change
    $('input').on('input change', function() {
        $(this).removeClass('is-invalid');
        $('#' + $(this).attr('id') + '_error').text('');
    });
}); 