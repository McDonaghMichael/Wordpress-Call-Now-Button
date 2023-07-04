jQuery(document).ready(function($) {
    // Update number input fields on range input change
    $('#call_button_width, #call_button_height, #call_button_padding, #call_button_margin').on('input', function() {
        $('#' + this.id + '_number').val($(this).val());
    });
});
