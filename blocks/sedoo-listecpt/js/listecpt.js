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
            jQuery('.acf-field-5f733e28e91fc select').empty(); 
            jQuery('.acf-field-5f733e28e91fc select').append('<option value=""> Selectionner un tag </option>');
            for (const [key, value] of Object.entries(tags_term_array)) {
              jQuery('.acf-field-5f733e28e91fc select').append('<option value="'+key+'">'+value+'</option>'); 
            }       
        });  
    });


    //////////////
    // FILL THE CATEGORY AND THE TAG BY PREVIOUS VALUE
    //////////////
    var actualisation_des_champs = 0;
    jQuery( "body" ).hover(function() {
      if(actualisation_des_champs == 0) {
        /// the category
        var value_cat = jQuery('.field_5f733e10e91fb').text();
        jQuery('.acf-field-5f733e10e91fb select').append('<option value=""> '+value_cat+'</option>');

        // the tag
        var value_tag = jQuery('.field_5f733e28e91fc').text();
        jQuery('.acf-field-5f733e28e91fc select').append('<option value=""> '+value_tag+'</option>');

        actualisation_des_champs++;
      }
    });
});