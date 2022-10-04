<?php

// Register ACF fields  
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
        // register an accordion block
        acf_register_block(array(
            'name'              => 'accordion',
            'title'             => __('Accordions'),
            'description'       => __('Accordion Content (e.g. for FAQs)'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'design',
            'icon'              => 'excerpt-view',
            'keywords'          => array( 'accordion', 'faqs'),
            'mode'              => 'edit',
        )); 
        acf_register_block(array(
            'name'              => 'tabbed',
            'title'             => __('Tabbed Content'),
            'description'       => __('Tabbed Content Areas'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'design',
            'icon'              => 'index-card',
            'keywords'          => array( 'tabs, tabbed'),
            'mode'              => 'edit',
        )); 
    }
}
add_action('acf/init', 'my_acf_init');  

//render ACF fields
function my_acf_block_render_callback( $block ) {
    
    // convert name ("acf/testimonials") into path friendly slug ("testimonials")
    $slug = str_replace('acf/', '', $block['name']);
    
    // include a template part from within the "template-parts/block" folder
    if( file_exists( get_theme_file_path("/blocks/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/content-{$slug}.php") );
    }
}

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_6136237aea0be',
        'title' => 'Block : Accordion',
        'fields' => array(
            array(
                'key' => 'field_61362417de062',
                'label' => 'Accordion',
                'name' => 'accordions',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Accordion',
                'sub_fields' => array(
                    array(
                        'key' => 'field_6136239b5f762',
                        'label' => 'Accordion Heading',
                        'name' => 'accordion_heading',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                    array(
                        'key' => 'field_613623a45f763',
                        'label' => 'Accordion Content',
                        'name' => 'accordion_content',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/accordion',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => false,
    ));
    
    acf_add_local_field_group(array(
        'key' => 'group_613a28a6712fd',
        'title' => 'Block: Tabbed Content',
        'fields' => array(
            array(
                'key' => 'field_613a28acb00fb',
                'label' => 'Tabs',
                'name' => 'tabs',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_613a28b6b00fc',
                        'label' => 'Tab Label',
                        'name' => 'tab_label',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '25',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_613a28c3b00fd',
                        'label' => 'Tab Content',
                        'name' => 'tab_content',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '75',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/tabbed',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => false,
    ));
    
    acf_add_local_field_group(array(
        'key' => 'group_63073f2eab8d2',
        'title' => 'Reusable Block Settings',
        'fields' => array(
            array(
                'key' => 'field_63073fbcd2676',
                'label' => 'Header Block ID',
                'name' => 'header_block_id',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_63073fd0d2677',
                'label' => 'Footer Block ID',
                'name' => 'footer_block_id',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_63073fd1d2678',
                'label' => 'Article Footer Block ID',
                'name' => 'article_footer_block_id',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_630742955a4e2',
                'label' => 'Blog ID',
                'name' => 'blog_id',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-reusable-block-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
    
    endif;		