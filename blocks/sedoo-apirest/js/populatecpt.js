    //////
    // REMPLIR LE CHAMPS CPT EN FONCTION DU SITE
    //////
    jQuery(document).ready(function(){            
        var tableau_taxo_par_cpt = [];
        var url_website;
        var cptchoix;
        var decompte_valeur = [];
        jQuery(document).on('change', '[data-key="field_5e9eb8bab097a"] .acf-input select', function(e) { // ah changement du select website
            url_website = jQuery(this).val(); 
            cpt_json_url = url_website+'/wp-json/wp/v2/types'; // l'url de recup des cpt

            jQuery.ajax({
                url: cpt_json_url,
                dataType:'text', 
                success:function(results_cpt) {
                    // le result me renvoie la liste des cpt et des taxos par cpt
                    results_cpt = JSON.parse(results_cpt);
                    jQuery('.acf-field-5e9ec0daae508 select').empty(); // empty cpt select
                    jQuery('.acf-field-5e9ef4bfb9e24 select').empty(); // empty ctx select
                    jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
                    jQuery('.acf-field-5e9ec0daae508 select').append('<option value=""> Selectionner un type de contenu </option>');
                    for (const [key, value] of Object.entries(results_cpt)) {
                        tableau_taxo_par_cpt[value.rest_base] = value.taxonomies;
                        jQuery('.acf-field-5e9ec0daae508 select').append('<option value="'+value.rest_base+'">'+value.name+'</option>'); // je remplis le select par les cpt 
                    }
                }
            });
        });

        //////
        // REMPLIR LE CHAMPS CTX EN FONCTION DU CPT
        //////
        jQuery(document).on('change', '[data-key="field_5e9ec0daae508"] .acf-input select', function(e) { // au changement du champs cpt
            cptchoix = jQuery(this).val();
            liste_taxo_du_cpt = tableau_taxo_par_cpt[cptchoix];
          
            
            jQuery('.acf-field-5e9ef4bfb9e24 select').empty(); // empty ctx select
            jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
            // if taxo for cpt
            if(liste_taxo_du_cpt.length > 0) {
                jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Selectionner une taxonomie </option>');   // je remplis le select ctx
                for (const [key, value] of Object.entries(liste_taxo_du_cpt)) {
                    url_ctx_name = url_website+'/wp-json/wp/v2/taxonomies/'+value;  // je construit une url pour recuperer et afficher le nom de chaque taxo
                    jQuery.ajax({
                        url: url_ctx_name,
                        dataType:'text', 
                        success:function(results_ctx_name) {
                            results_ctx_name = JSON.parse(results_ctx_name);
                            jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value="'+value+'">'+results_ctx_name.name+'</option>');
                        }
                    });
                }
            } else {
                jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Aucune taxonomie </option>');
            }
        });

        //////
        // REMPLIR LE CHAMPS TERM EN FONCTION DU CTX
        //////
        jQuery(document).on('change', '[data-key="field_5e9ef4bfb9e24"] .acf-input select', function(e) { // au changement du champs ctx
            jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
            ctxchoix = jQuery(this).val();
            ctx_list_json_url = url_website+'/wp-json/wp/v2/'+ctxchoix; 
                       
            jQuery.ajax({
                url: ctx_list_json_url,
                dataType:'text', 
                success:function(results_terms) {
                    results_terms = JSON.parse(results_terms);
                    if(results_terms.length > 0) {
                        jQuery('.acf-field-5e9efed45552f select').append('<option value=""> Selectionner un terme </option>');
                        for (var i = 0; i < results_terms.length; i++) {
                            // on fait le decompte du nombre de contenu dans chaque term en fct du cpt et du ctx
                            urldecompte = url_website+'/wp-json/wp/v2/'+cptchoix+'?'+ctxchoix+'='+results_terms[i].id;
                            jQuery.ajax({
                                url: urldecompte,
                                dataType:'text', 
                                success:function(result_decompte) {
                                    decompte_valeur = JSON.parse(result_decompte);
                                }
                            });
                            jQuery('.acf-field-5e9efed45552f select').append('<option value="'+results_terms[i].id+'">'+results_terms[i].name+'</option>');
                        }
                    } else {
                        jQuery('.acf-field-5e9efed45552f select').append('<option value=""> Aucun terme </option>');
                    }

                }
            });
        });



	});
	