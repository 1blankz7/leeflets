<?php
namespace Leeflets\Template;

class Upload {
	private $router;

	function __construct( \Leeflets\Router $router ) {
		$this->router = $router;
	}

	public function url( $url = '' ) {
		echo $this->get_url( $url );
	}

	public function get_url( $url = '' ) {
		return $this->router->get_uploads_url( $url );
	}
}