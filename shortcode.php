<?php

/**
 * Plugin Name:       Shortcode Making
 * Plugin URI:        https://sakibmd.xyz/
 * Description:       Generate QR Code for every single post.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sakib Mohammed
 * Author URI:        https://sakibmd.xyz/
 * License:           GPL v2 or later
 * License URI:
 * Text Domain:       shortcode-practice
 * Domain Path:       /languages
 */

function sc_shortcode_practice()
{
    load_plugin_textdomain('shortcode-practice', false, dirname(__FILE__) . "/languages");
}
add_action("plugins_loaded", "sc_shortcode_practice"); //**sc = prefix


function button_callback($args)
{
    $default = array(
        'type' => 'primary',
        'url' => '',
        'title' => __('Default', 'shortcode-practice'),
    );

    $button_attributes = shortcode_atts($default, $args);

    return sprintf(' <div class="justify-content-center"><a class="btn btn-%s full-width" href="%s" > %s </a></div>  ',
        $button_attributes['type'],
        $button_attributes['url'],
        $button_attributes['title']
    );
}
add_shortcode('button', 'button_callback');

function button2_callback($attributes, $content = '')
{

    $default = array(
        'type' => 'primary',
        'url' => '',
        'title' => __('Default', 'shortcode-practice'),
    );

    $button_attributes = shortcode_atts($default, $attributes);

    return sprintf(' <div class="justify-content-center"><a class="btn btn-%s full-width" href="%s" > %s </a></div>  ',
        $button_attributes['type'],
        $button_attributes['url'],
        do_shortcode($content)
    );
}
add_shortcode('button2', 'button2_callback');

function uc_callback($attributes, $content = '')
{
    return strtoupper(do_shortcode($content));
}

add_shortcode('uc', 'uc_callback');

function gmap_callback($attributes)
{

    $default = array(
        'place' => 'Dhaka',
        'width'=>'800',
        'height'=>'500',
        'zoom'=>'14'
    );

    $params = shortcode_atts($default, $attributes);

    $map = <<<EOD
    <div>
        <div>
            <iframe width="{$params['width']}" height="{$params['height']}"
                    src="https://maps.google.com/maps?q={$params['place']}&t=&z={$params['zoom']}&ie=UTF8&iwloc=&output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
            </iframe>
        </div>
    </div>
    EOD;
    return $map;

}

add_shortcode('gmap', 'gmap_callback');

function enque_scripts()
{
    wp_enqueue_style('bootstrap-css', '//stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
}

add_action('wp_enqueue_scripts', 'enque_scripts');
