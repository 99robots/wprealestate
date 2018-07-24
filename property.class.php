<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of property
 *
 * @author hozyali
 */
class property {

    function PropertyBox($keyword) {
        $args_property = array(
	'post_type'=> 'property',
	'posts_per_page' => $et_re_pp_listing,
	'paged' => get_query_var('paged'),
	's' => $keyword
        );

        return query_posts( $args_property );
    }
    //put your code here
}
