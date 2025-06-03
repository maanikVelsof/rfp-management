$(document).ready(function() {
    // Initialize form validation
    $('#quoteForm').on('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        let form = this;
        
        // Initialize validation variables
        let priceValidation, descriptionValidation, quantityValidation;
        
        // Clear previous errors
        $('.error-message').text('');
        $('.form-control').removeClass('is-invalid');
        
        // Price Per Unit validation
        priceValidation = velovalidation.checkMandatory($('#price_per_unit'));
        if (priceValidation !== true) {
            isValid = false;
            $('#price_per_unit').addClass('is-invalid');
            $('#price_per_unit_error').text(priceValidation);
        } else {
            // Additional validation for amount
            let priceAmountValidation = velovalidation.checkAmount($('#price_per_unit'));
            if (priceAmountValidation !== true) {
                isValid = false;
                $('#price_per_unit').addClass('is-invalid');
                $('#price_per_unit_error').text(priceAmountValidation);
            }
        }

        // Item Description validation
        descriptionValidation = velovalidation.checkMandatory($('#item_description'));
        if (descriptionValidation !== true) {
            isValid = false;
            $('#item_description').addClass('is-invalid');
            $('#item_description_error').text(descriptionValidation);
        } else if ($('#item_description').val().length < 10) {
            isValid = false;
            $('#item_description').addClass('is-invalid');
            $('#item_description_error').text('Item description must be at least 10 characters long');
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
            } else if (parseInt($('#quantity').val()) < 1) {
                isValid = false;
                $('#quantity').addClass('is-invalid');
                $('#quantity_error').text('Quantity must be at least 1');
            }
        }

        // Debug validation results
        console.log('Validation Results:', {
            price: priceValidation || 'Not validated',
            description: descriptionValidation || 'Not validated',
            quantity: quantityValidation || 'Not validated',
            isValid: isValid
        });

        // Calculate total cost
        var price = parseFloat($('#price_per_unit').val()) || 0;
        var qty = parseInt($('#quantity').val()) || 0;
        var totalCost = price * qty;
        $('#total_cost').val(totalCost.toFixed(2));

        // Submit form if valid
        if (isValid) {
            form.submit();
        }
    });

    // Calculate total cost when price or quantity changes
    $('#price_per_unit, #quantity').on('input', function() {
        var price = parseFloat($('#price_per_unit').val()) || 0;
        var qty = parseInt($('#quantity').val()) || 0;
        var totalCost = price * qty;
        $('#total_cost').val(totalCost.toFixed(2));
    });

    // Real-time validation on input change
    $('input, textarea').on('input', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.error-message').text('');
    });
}); 