jQuery(document).ready(function(){   
    var cpt_choose;
    //////////
    // Fired when the select CPT field is changed
    ////////
    jQuery(document).on('change', '[data-key="field_5f733cdde91f9"] .acf-input select', function(e) { 
        cpt_choose = jQuery(this).val(); 
        
              

        //////////
        // FILL CATEGORY FIELD 
        ////////
        jQuery.ajax({
          url: ajaxurl,
          type: "POST",
          data: {
            'post_type':cpt_choose,
            'action': 'sedoo_listecpt_blocks_acf_populate_categorieslist'
          }
        }).done(function(response) {
          var category_term_array = JSON.parse(response);
            jQuery('.acf-field-5f733e10e91fb select').empty(); 
            jQuery('.acf-field-5f733e10e91fb select').append('<option value=""> Selectionner une catégorie </option>');
            for (const [key, value] of Object.entries(category_term_array)) {
              jQuery('.acf-field-5f733e10e91fb select').append('<option value="'+key+'">'+value+'</option>');  
            }       
        });
        

        //////////
        // FILL TAG FIELD 
        ////////
        jQuery.ajax({
          url: ajaxurl,
          type: "POST",
          data: {
            'post_type':cpt_choose,
            'action': 'sedoo_listecpt_blocks_acf_populate_tagslist'
          }
        }).done(function(response) {
          var tags_term_array = JSON.parse(response);
          console.log(tags_term_array);
            jQuery('.acf-field-5f733e28e91fc select').empty(); 
            jQuery('.acf-field-5f733e28e91fc select').append('<option value=""> Selectionner un tag </option>');
            for (const [key, value] of Object.entries(tags_term_array)) {
              jQuery('.acf-field-5f733e28e91fc select').append('<option value="'+key+'">'+value+'</option>'); 
            }       
        });
        
    });
});