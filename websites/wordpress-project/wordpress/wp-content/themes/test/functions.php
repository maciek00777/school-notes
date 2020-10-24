<?php

    function register_menus()
    {
        register_nav_menus(
            array(
            'main-nav'=>'menu główne',
            'footer-nav'=>'menu dolne'
            )
        );
    }


    add_action('init','register_menus');



?>