<?php 

/*
Plugin Name: Footer Comprehension
Description: Show customized footer comprihension.
Version: 1.0.0
Author: Malav V
Author URI: https://malavvasita.github.io/
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class footerComprehension{
    function __construct() {
        add_action( 'init', array( $this, 'admin_assets' ) );

        add_action( 'enqueue_block_editor_assets', function() {
            wp_enqueue_style( 
                'exotic-footer-para-editor-css', 
                plugin_dir_url( __FILE__ ) . 'src/css/editor.css'
            );
        } );

        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_style( 
                'exotic-footer-para-front-end-css',
                plugin_dir_url( __FILE__ ) . 'src/css/editor.css'
            );
        } );
    }

    function admin_assets() {
        
        wp_register_script( 
            'exotic-footer-para', 
            plugin_dir_url( __FILE__ ) . 'build/index.js',
            array( 
                'wp-blocks',
                'wp-element',
                'wp-components',
                'wp-block-editor',
                'wp-i18n'
            )
        );

        register_block_type(
            "exotic/footer-para",
            array(
                "editor_script" => "exotic-footer-para",
                "render_callback" => array( $this, "theHTML" )
            )
        );
    }

    function theHTML( $attributes ){

        if( ! isset( $attributes['scheme'] ) ){
            $attributes['scheme'] = 'exotic-scheme-1';
        }
        
        $html = "<div class='exotic-para-result " . $attributes['scheme'] . "'>" .
            $attributes['content']
            . "</div>";

        return $html;
    }
}

$footerComprehension = new footerComprehension();