    //////
    // REMPLIR LE CHAMPS CPT EN FONCTION DU SITE
    //////
    jQuery(document).ready(function(){
		jQuery(document).on('change', '[data-key="field_5e9eb8bab097a"] .acf-input select', function(e) { // ah changement du select website
            idwebsite = jQuery(this).val(); // recuperer l'id du site choisi
            jQuery.ajax({
                url: ajaxurl,
                dataType:'text', 
                data: {
                    'action': 'sedoo_labtools_acf_populate_cptlist', //   go to sedoo-wppl-apirest.php
                    'website' : idwebsite // l'id du site web choisi
                },
                success:function(results) {
                    // le results me renvoie deux tableaux que je veux traiter differement, le resultat et le $tableau_ctx_par_cpt
                    results = JSON.parse(results);
                    resultats = results[0]; // le résultat des cpt
                    tableau_taxonomies = results[1]; // la liste des taxonomies par cpt
                    jQuery('.acf-field-5e9ec0daae508 select').empty(); // empty cpt select
                    jQuery('.acf-field-5e9ef4bfb9e24 select').empty(); // empty ctx select
                    jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
                    jQuery('.acf-field-5e9ec0daae508 select').append('<option value=""> Selectionner un type de contenu </option>');
                    for (const property in resultats) {
                        jQuery('.acf-field-5e9ec0daae508 select').append('<option value="'+property+'">'+resultats[property]+'</option>');
                    }

                    //////
                    // REMPLIR LE CHAMPS CTX EN FONCTION DU CPT


                    //
                    // cette section peut etre optimisée : j'envoie en php un tableau dans lequel je vais chercher des infos, ca peut se faire en js puis envoyer seulement le resultat de la recherche pour recuperer le name des taxo
                    //
                    //////
                    jQuery(document).on('change', '[data-key="field_5e9ec0daae508"] .acf-input select', function(e) { // au changement du champs cpt
                        cptchoix = jQuery(this).val();
                        jQuery.ajax({
                            url: ajaxurl, 
                            dataType:'text', 
                            data: {
                                'action': 'sedoo_labtools_acf_populate_ctxlist', //   go to sedoo-wppl-apirest.php
                                'cpt' : cptchoix, // le choix cpt de l'utilisateur
                                'taxo_tableau' : tableau_taxonomies // le tableau des taxonomies par cpt
                            },
                            success:function(taxoducpt) {
                                taxoducpt = JSON.parse(taxoducpt);
                                jQuery('.acf-field-5e9ef4bfb9e24 select').empty(); // empty ctx select
                                jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
                                // if taxo for cpt
                                if(taxoducpt) {
                                    jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Selectionner une taxonomie </option>');
                                    for (const property_tax in taxoducpt) {
                                        jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value="'+taxoducpt[property_tax]+'">'+property_tax+'</option>');
                                    }
                                } else {
                                    jQuery('.acf-field-5e9ef4bfb9e24 select').append('<option value=""> Aucune taxonomie </option>');
                                }

                                //////
                                // REMPLIR LE CHAMPS TERM EN FONCTION DU CTX
                                //////
                                jQuery(document).on('change', '[data-key="field_5e9ef4bfb9e24"] .acf-input select', function(e) { // au changement du champs ctx
                                    ctxchoix = jQuery(this).val();
                                    jQuery.ajax({
                                        url: ajaxurl, 
                                        dataType:'text', 
                                        data: {
                                            'action': 'sedoo_labtools_acf_populate_termlist', //   go to sedoo-wppl-apirest.php
                                            'ctx' : ctxchoix, // le choix ctx de l'utilisateur
                                            'cpt' : cptchoix // le choix cpt de l'utilisateur
                                        },
                                        success:function(terms_list) {
                                            terms = JSON.parse(terms_list);
                                            jQuery('.acf-field-5e9efed45552f select').empty(); // empty term select
                                            // if terms in taxo
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
	