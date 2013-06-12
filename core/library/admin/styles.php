<?php
namespace Leeflets\Admin;

class Styles extends \Leeflets\Styles {
	function __construct( $base_url, \Leeflets\Router $router, $default_version = '' ) {
		parent::__construct( $base_url, $router, $default_version );

        $this->enqueue( 'bootstrap' );
        $this->enqueue( 'bootstrap-responsive' );
        $this->enqueue( 'bootstrap-datepicker' );
        $this->enqueue( 'bootstrap-wysihtml5' );
        $this->enqueue( 'jquery-fileupload' );

        $this->add_enqueue( 'lf-style', '/core/theme/asset/css/style.css' );
	}
}
