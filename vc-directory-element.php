<?php

/**
* Adds new shortcode "info-box-shortcode" and registers it to
* the WPBakery Visual Composer plugin
*
*/


// If this file is called directly, abort

if ( ! defined( 'ABSPATH' ) ) {
    die ('Silly human what are you doing here');
}


if ( ! class_exists( 'vcInfoBox' ) ) {

	class vcInfoBox {


		/**
		* Main constructor
		*
		*/
		public function __construct() {

			// Registers the shortcode in WordPress
			add_shortcode( 'info-box-shortcode', array( 'vcInfoBox', 'output' ) );

			// Map shortcode to Visual Composer
			if ( function_exists( 'vc_lean_map' ) ) {
				vc_lean_map( 'info-box-shortcode', array( 'vcInfoBox', 'map' ) );
			}

		}


		/**
		* Map shortcode to VC
    *
    * This is an array of all your settings which become the shortcode attributes ($atts)
		* for the output.
		*
		*/
		public static function map() {
			return array(
				'name'        => esc_html__( 'VIPBOX', 'text-domain' ),
				'description' => esc_html__( 'Add new VIPBOX', 'text-domain' ),
				'base'        => 'vc_infobox',
				'category' => __('VIP BOX', 'text-domain'),
				'icon' => plugin_dir_path( __FILE__ ) . 'assets/img/note.png',
				'params'      => array(
					array(
						'type'       => 'attach_image',
						'holder' => 'img',
						'heading' => __( 'Image', 'text-domain' ),
                        'param_name' => 'bgimg',
						// 'value' => __( 'Default value', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'VIPBOX',
					),

					array(
                        'type' => 'textfield',
                        'holder' => 'h3',
                        'class' => 'title-class',
                        'heading' => __( 'Section Title', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'VIPBOX',
                    ),
                    
                    array(
                        'type' => 'textarea_html',
                        'holder' => 'div',
                        'class' => 'describe-class',
                        'heading' => __( 'Short Description', 'text-domain' ),
                        'param_name' => 'short-dscription',
                        'value' => __( '', 'text-domain' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'VIPBOX',
                    ),

                    array(
                        'type' => 'vc_link',
                        'class' => 'wpc-link-class',
                        'heading' => __( 'Link', 'text-domain' ),
                        'param_name' => 'link',
                        'value' => __( '', 'text-domain' ),
                        'description' => __( 'Enter description.', 'text-domain' ),
                        // 'admin_label' => false,
                        // 'weight' => 0,
                        'group' => 'VIPBOX',
                    ),
				),
			);
		}


		/**
		* Shortcode output
		*
		*/
		public static function output( $atts, $content = null ) {

			extract(
				shortcode_atts(
					array(
						'bgimg' => 'bgimg',
						'title'   => '',
                        'short-dscription' => '',
						'link' => 'link',
					),
					$atts
				)
			);

  		$img_url = wp_get_attachment_image_src( $bgimg, "large");
		$href = vc_build_link( $link );

        // Fill $html var with data
        $html = '
        <div class="wpc-directory-wrap" >
            <a class="wpc-link-class" href="'.$href["url"].'" target="_blank">
                <img class="wpc-directory-image" src="'. $img_url[0] .'">
            </a>  
                <div class="wpb-description">' . $short-dscription . '</div>
            <a class="wpc-link-class" href="'.$href["url"].'" target="_blank">
                <h3 class="wpc-directory-title">' . $title . '</h3>
            </a>
        </div>';

        return $html;

		}

	}

}
new vcInfoBox;
