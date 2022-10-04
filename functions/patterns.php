<?php 

function custom_pattern_categories() {
    register_block_pattern_category(
        'custom',
        array(  
            'label' => __( 'Custom', 'custom' )           
        )
    );
}
add_action( 'init', 'custom_pattern_categories' );

function custom_patterns() {
   register_block_pattern(
        'custom/columns-border',
        array(
            'title'   => __( 'Columns with Border' ),
            'categories' => array( 'custom'),
            'content' => "",
        ),
    );
}
//add_action( 'init', 'custom_patterns' );
