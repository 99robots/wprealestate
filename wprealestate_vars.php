<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
        if (get_option('et_re_pp_listing') == '') {
            $et_re_pp_listing = '10';
        } else {	
                $et_re_pp_listing = get_option('et_re_pp_listing');
        }
