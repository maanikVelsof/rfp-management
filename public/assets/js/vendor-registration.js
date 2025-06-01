$(document).ready(function() {
    // Initialize Select2 with Bootstrap 5 theme
    $('#categories').select2({
        placeholder: 'Select categories',
        width: '100%',
        theme: 'bootstrap-5'
    });

    // Form validation
    $('#vendorRegisterForm').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        let form = this;
        
        // Initialize validation variables
        let nameValidation, emailValidation, emailMandatory, 
            passwordValidation, passwordMandatory,
            companyValidation, revenueValidation, revenueMandatory,
            employeesValidation, employeesMandatory,
            phoneValidation, phoneMandatory,
            gstValidation, panValidation;
        
        // Clear previous errors
        $('.error-message').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
        $('.select2-selection').removeClass('is-invalid');

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

        // Company Name validation
        companyValidation = velovalidation.checkMandatory($('#company_name'));
        if (companyValidation !== true) {
            isValid = false;
            $('#company_name').addClass('is-invalid');
            $('#company_name_error').text(companyValidation);
        }

        // Revenue validation - first check mandatory, then amount format
        revenueMandatory = velovalidation.checkMandatory($('#revenue'));
        if (revenueMandatory !== true) {
            isValid = false;
            $('#revenue').addClass('is-invalid');
            $('#revenue_error').text(revenueMandatory);
        } else {
            revenueValidation = velovalidation.checkAmount($('#revenue'));
            if (revenueValidation !== true) {
                isValid = false;
                $('#revenue').addClass('is-invalid');
                $('#revenue_error').text(revenueValidation);
            }
        }

        // Number of Employees validation - first check mandatory, then numeric
        employeesMandatory = velovalidation.checkMandatory($('#no_of_employees'));
        if (employeesMandatory !== true) {
            isValid = false;
            $('#no_of_employees').addClass('is-invalid');
            $('#no_of_employees_error').text(employeesMandatory);
        } else {
            employeesValidation = velovalidation.isNumeric($('#no_of_employees'));
            if (employeesValidation !== true) {
                isValid = false;
                $('#no_of_employees').addClass('is-invalid');
                $('#no_of_employees_error').text(employeesValidation);
            }
        }

        // GST Number validation (mandatory)
        gstValidation = velovalidation.checkMandatory($('#gst_number'));
        if (gstValidation !== true) {
            isValid = false;
            $('#gst_number').addClass('is-invalid');
            $('#gst_number_error').text(gstValidation);
        } else {
            const gstPattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
            if (!gstPattern.test($('#gst_number').val().trim())) {
                isValid = false;
                $('#gst_number').addClass('is-invalid');
                $('#gst_number_error').text('Invalid GST Number format (e.g., 29ABCDE1234F1Z5)');
            }
        }

        // PAN Number validation (mandatory)
        panValidation = velovalidation.checkMandatory($('#pan_number'));
        if (panValidation !== true) {
            isValid = false;
            $('#pan_number').addClass('is-invalid');
            $('#pan_number_error').text(panValidation);
        } else {
            const panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            if (!panPattern.test($('#pan_number').val().trim())) {
                isValid = false;
                $('#pan_number').addClass('is-invalid');
                $('#pan_number_error').text('Invalid PAN Number format (e.g., ABCDE1234F)');
            }
        }

        // Phone Number validation - first check mandatory, then format and length
        phoneMandatory = velovalidation.checkMandatory($('#phone_number'));
        if (phoneMandatory !== true) {
            isValid = false;
            $('#phone_number').addClass('is-invalid');
            $('#phone_number_error').text(phoneMandatory);
        } else {
            // First check phone number length
            let phoneValue = $('#phone_number').val().trim().replace(/[^0-9]/g, ''); // Remove non-digits
            if (phoneValue.length > 15) {
                isValid = false;
                $('#phone_number').addClass('is-invalid');
                $('#phone_number_error').text('Phone number cannot be more than 15 digits');
            } else if (phoneValue.length < 10) {
                isValid = false;
                $('#phone_number').addClass('is-invalid');
                $('#phone_number_error').text('Phone number must be at least 10 digits');
            } else {
                // Then check phone number format
                phoneValidation = velovalidation.checkPhoneNumber($('#phone_number'));
                if (phoneValidation !== true) {
                    isValid = false;
                    $('#phone_number').addClass('is-invalid');
                    $('#phone_number_error').text(phoneValidation);
                }
            }
        }

        // Categories validation
        if ($('#categories').val().length === 0) {
            isValid = false;
            $('#categories').next('.select2-container').find('.select2-selection').addClass('is-invalid');
            $('#categories_error').text('Please select at least one category');
        }

        // Terms validation
        if (!$('#terms').is(':checked')) {
            isValid = false;
            $('#terms').addClass('is-invalid');
            $('#terms_error').text('You must accept the terms and conditions');
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
            company: companyValidation || 'Not validated',
            revenue: {
                mandatory: revenueMandatory || 'Not checked',
                format: revenueValidation || 'Not validated'
            },
            employees: {
                mandatory: employeesMandatory || 'Not checked',
                format: employeesValidation || 'Not validated'
            },
            gst: gstValidation || 'Not validated',
            pan: panValidation || 'Not validated',
            phone: {
                mandatory: phoneMandatory || 'Not checked',
                format: phoneValidation || 'Not validated'
            },
            isValid: isValid
        });

        // Submit form if valid
        if (isValid) {
            form.submit(); // Use the stored form reference
        }
    });

    // Real-time validation on input change
    $('input, select').on('input change', function() {
        $(this).removeClass('is-invalid');
        if ($(this).attr('id') === 'categories') {
            $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
        }
        $('#' + $(this).attr('id') + '_error').text('');
    });

    // Clear validation errors when Select2 changes
    $('#categories').on('change', function() {
        $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
        $('#categories_error').text('');
    });
}); 