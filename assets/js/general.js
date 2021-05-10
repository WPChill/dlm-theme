// Get variation_id for Single Product radio buttons
jQuery(document).ready(function($) {
        selectVariation($('#pa_license input:checked')[0]);
        $('#pa_license input').on('change', function() {
            $('form.variations_form').find('label').removeClass('selected');
            selectVariation(this);
        });
        function selectVariation(radio) {
            var form = $('form.variations_form').data( 'product_variations' );
            for (let variation = 0; variation < form.length; variation++) {
                if (form[variation]['attributes'][radio.name] == radio.value) {
                    variation_id = form[variation]['variation_id'];
                }
            }
            $('form.variations_form').find('label[for="' + radio.id + '"]').addClass('selected');
            $('form.variations_form').find( 'input[name="variation_id"], input.variation_id' ).val( variation_id );
        }
});