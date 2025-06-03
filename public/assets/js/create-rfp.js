$(document).ready(function() {
    // Initialize select2 for better vendor selection
    $('#vendors').select2({
        placeholder: "Select vendors",
        allowClear: true
    });

    // Form validation
    $('form').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        let form = this;
        
        // Initialize validation variables
        let itemNameValidation, itemDescriptionValidation, quantityValidation,
            lastDateValidation, minimumPriceValidation, maximumPriceValidation,
            categoryValidation, vendorsValidation;
        
        // Clear previous errors
        $('.error-message').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
        $('.select2-selection').removeClass('is-invalid');

        // Item Name validation
        itemNameValidation = velovalidation.checkMandatory($('#item_name'));
        if (itemNameValidation !== true) {
            isValid = false;
            $('#item_name').addClass('is-invalid');
            $('#item_name_error').text(itemNameValidation);
        }

        // Item Description validation
        itemDescriptionValidation = velovalidation.checkMandatory($('#item_description'));
        if (itemDescriptionValidation !== true) {
            isValid = false;
            $('#item_description').addClass('is-invalid');
            $('#item_description_error').text(itemDescriptionValidation);
        }

        // Quantity validation
        quantityValidation = velovalidation.checkMandatory($('#quantity'));
        if (quantityValidation !== true) {
            isValid = false;
            $('#quantity').addClass('is-invalid');
            $('#quantity_error').text(quantityValidation);
        } else {
            // Additional validation for positive number
            let quantityNumericValidation = velovalidation.isNumeric($('#quantity'));
            if (quantityNumericValidation !== true) {
                isValid = false;
                $('#quantity').addClass('is-invalid');
                $('#quantity_error').text(quantityNumericValidation);
            }
        }

        // Last Date validation
        lastDateValidation = velovalidation.checkMandatory($('#last_date'));
        if (lastDateValidation !== true) {
            isValid = false;
            $('#last_date').addClass('is-invalid');
            $('#last_date_error').text(lastDateValidation);
        }

        // Minimum Price validation
        minimumPriceValidation = velovalidation.checkMandatory($('#minimum_price'));
        if (minimumPriceValidation !== true) {
            isValid = false;
            $('#minimum_price').addClass('is-invalid');
            $('#minimum_price_error').text(minimumPriceValidation);
        } else {
            // Additional validation for amount
            let minimumPriceAmountValidation = velovalidation.checkAmount($('#minimum_price'));
            if (minimumPriceAmountValidation !== true) {
                isValid = false;
                $('#minimum_price').addClass('is-invalid');
                $('#minimum_price_error').text(minimumPriceAmountValidation);
            }
        }

        // Maximum Price validation
        maximumPriceValidation = velovalidation.checkMandatory($('#maximum_price'));
        if (maximumPriceValidation !== true) {
            isValid = false;
            $('#maximum_price').addClass('is-invalid');
            $('#maximum_price_error').text(maximumPriceValidation);
        } else {
            // Additional validation for amount
            let maximumPriceAmountValidation = velovalidation.checkAmount($('#maximum_price'));
            if (maximumPriceAmountValidation !== true) {
                isValid = false;
                $('#maximum_price').addClass('is-invalid');
                $('#maximum_price_error').text(maximumPriceAmountValidation);
            }
        }

        // Compare minimum and maximum prices
        if (isValid && parseFloat($('#minimum_price').val()) > parseFloat($('#maximum_price').val())) {
            isValid = false;
            $('#maximum_price').addClass('is-invalid');
            $('#maximum_price_error').text('Maximum price must be greater than minimum price');
        }

        // Category validation
        categoryValidation = velovalidation.checkMandatory($('#category_id'));
        if (categoryValidation !== true) {
            isValid = false;
            $('#category_id').addClass('is-invalid');
            $('#category_id_error').text(categoryValidation);
        }

        // Vendors validation
        if ($('#vendors').val() === null || $('#vendors').val().length === 0) {
            isValid = false;
            $('#vendors').next('.select2-container').find('.select2-selection').addClass('is-invalid');
            $('#vendors_error').text('Please select at least one vendor');
        }

        // Debug validation results
        console.log('Validation Results:', {
            itemName: itemNameValidation || 'Not validated',
            itemDescription: itemDescriptionValidation || 'Not validated',
            quantity: quantityValidation || 'Not validated',
            lastDate: lastDateValidation || 'Not validated',
            minimumPrice: minimumPriceValidation || 'Not validated',
            maximumPrice: maximumPriceValidation || 'Not validated',
            category: categoryValidation || 'Not validated',
            vendors: vendorsValidation || 'Not validated',
            isValid: isValid
        });

        // Submit form if valid
        if (isValid) {
            form.submit();
        }
    });

    // Real-time validation on input change
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
        if ($(this).attr('id') === 'vendors') {
            $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
        }
        $('#' + $(this).attr('id') + '_error').text('');
    });

    // Clear validation errors when Select2 changes
    $('#vendors').on('change', function() {
        $(this).next('.select2-container').find('.select2-selection').removeClass('is-invalid');
        $('#vendors_error').text('');
    });
}); 