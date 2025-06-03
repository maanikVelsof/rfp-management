$(document).ready(function() {
    // Form validation
    $('form').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        let form = this;
        
        // Initialize validation variables
        let nameValidation, statusValidation;
        
        // Clear previous errors
        $('.error-message').text('');
        $('.form-control, .form-select').removeClass('is-invalid');

        // Name validation
        nameValidation = velovalidation.checkMandatory($('#name'));
        if (nameValidation !== true) {
            isValid = false;
            $('#name').addClass('is-invalid');
            $('#name_error').text(nameValidation);
        } else {
            // Additional validation for category name
            let categoryNameValidation = velovalidation.checkCategoryName($('#name'));
            if (categoryNameValidation !== true) {
                isValid = false;
                $('#name').addClass('is-invalid');
                $('#name_error').text(categoryNameValidation);
            }
        }

        // Status validation
        statusValidation = velovalidation.checkMandatory($('#status'));
        if (statusValidation !== true) {
            isValid = false;
            $('#status').addClass('is-invalid');
            $('#status_error').text(statusValidation);
        }

        // Debug validation results
        console.log('Validation Results:', {
            name: nameValidation || 'Not validated',
            status: statusValidation || 'Not validated',
            isValid: isValid
        });

        // Submit form if valid
        if (isValid) {
            form.submit();
        }
    });

    // Real-time validation on input change
    $('input, select').on('input change', function() {
        $(this).removeClass('is-invalid');
        $('#' + $(this).attr('id') + '_error').text('');
    });
}); 