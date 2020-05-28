
jQuery(document).ready(function() {
    jQuery(document).on('click','#show_more a',function() {
        sedoo_relatedblocks_load_more_content(this);
    });
});

function sedoo_relatedblocks_load_more_content(button) {
    var cpt = jQuery(button).attr('cpt');
    var offset = jQuery(button).attr('offset');
    var orderby = jQuery(button).attr('orderby');
    var order = jQuery(button).attr('order');
    var taxo = jQuery(button).attr('taxo');
    var post_number = jQuery(button).attr('post_number');
    var terms = jQuery(button).attr('terms');
    var sm = jQuery(button).attr('sm');
    var sm_text = jQuery(button).attr('smt');
    var sm_layout = jQuery(button).attr('layout');
    jQuery('.sedoo_blocks_relatedcontents').append('<div class="sedoo_related_block_loader"> <p> Loading... Please Wait </p> </div>');
    jQuery(button).remove();
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
          'action': 'sedoo_labtools_get_associate_content_arguments_ajax',
          'page_no': 1,
          'cpt': cpt,
          'offset': offset,
          'orderby': orderby,
          'post_number': post_number,
          'order': order,
          'taxo': taxo,
          'terms': terms,
          'sm': sm,
          'sm_text': sm_text,
          'layout': sm_layout,
        }
      }).done(function(response) {
          jQuery('.sedoo_blocks_relatedcontents').append(response);
          jQuery('.sedoo_related_block_loader').remove();
      });
}