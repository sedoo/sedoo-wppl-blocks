    //////
    // REMPLIR LE CHAMPS CPT EN FONCTION DU SITE
    //////
    jQuery(document).ready(function(){
		jQuery(document).on('change', '[data-key="field_5e9eb8bab097a"] .acf-input select', function(e) {
            idwebsite = jQuery(this).val();
            jQuery.ajax({
                url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                dataType:'text', //or HTML, JSON, etc.
                data: {
                    'action': 'sedoo_labtools_acf_populate_cptlist',
                    'website' : idwebsite
                },
                success:function(results) {
                    // le results me renvoie deux tableaux que je veux traiter differement, le resultat et le $tableau_ctx_par_cpt
                    results = JSON.parse(results);
                    resultats = results[0];
                    tableau_taxonomies = results[1];
                    jQuery('.acf-field-5e9ec0daae508 select').empty();
                    jQuery('.acf-field-5e9ef4bfb9e24 select').empty();
                    jQuery('.acf-field-5e9efed45552f select').empty();
                    jQuery('.acf-field-5e9ec0daae508 select').append('<option value=""> Selectionner un type de contenu </option>');
                    for (const property in resultats) {
                        jQuery('.acf-field-5e9ec0daae508 select').append('<option value="'+property+'">'+resultats[property]+'</option>');
                    }

                    //////
                    // REMPLIR LE CHAMPS CTX EN FONCTION DU CPT
                    //////
                    jQuery(document).on('change', '[data-key="field_5e9ec0daae508"] .acf-input select', function(e) {
                        cptchoix = jQuery(this).val();
                        jQuery.ajax({
                            url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                            dataType:'text', //or HTML, JSON, etc.
                            data: {
                                'action': 'sedoo_labtools_acf_populate_ctxlist',
                                'cpt' : cptchoix,
                                'taxo_tableau' : tableau_taxonomies
                            },
                            success:function(taxoducpt) {
                                taxoducpt = JSON.parse(taxoducpt);
                                jQuery('.acf-field-5e9ef4bfb9e24 select').empty();
                                jQuery('.acf-field-5e9efed45552f select').empty();
                                if(taxoducpt) {
                                    jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Selectionner une taxonomie </option>');
                                    for (const property_tax in taxoducpt) {
                                        console.log(property_tax);
                                        jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value="'+taxoducpt[property_tax]+'">'+property_tax+'</option>');
                                    }
                                } else {
                                    jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Aucune taxonomie </option>');
                                }

                                //////
                                // REMPLIR LE CHAMPS TERM EN FONCTION DU CTX
                                //////
                                jQuery(document).on('change', '[data-key="field_5e9ef4bfb9e24"] .acf-input select', function(e) {
                                    ctxchoix = jQuery(this).val();
                                    jQuery.ajax({
                                        url: ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                                        dataType:'text', //or HTML, JSON, etc.
                                        data: {
                                            'action': 'sedoo_labtools_acf_populate_termlist',
                                            'ctx' : ctxchoix,
                                            'cpt' : cptchoix
                                        },
                                        success:function(terms_list) {
                                            terms = JSON.parse(terms_list);
                                            jQuery('.acf-field-5e9efed45552f select').empty();
                                            if(terms) {
                                                jQuery('.acf-field-5e9efed45552f select').append('<option value=""> Selectionner un terme </option>');
                                                for (const property_term in terms) {
                                                    jQuery('.acf-field-5e9efed45552f select').append('<option value="'+property_term+'">'+terms[property_term]+'</option>');
                                                }
                                            } else {
                                                jQuery('.acf-field-5e9efed45552f select').append('<option value=""> Aucun terme </option>');
                                            }
                                        },
                                        error: function(errorThrown){
                                            console.log(errorThrown);
                                        }
                                    });  
                        
                                });


                            },
                            error: function(errorThrown){
                                console.log(errorThrown);
                            }
                        });  
            
                    });

                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });  

		});
	});
	