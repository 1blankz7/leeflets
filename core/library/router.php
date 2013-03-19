<?php
namespace Leeflets;

class Router {

    public $request_url, $base_request_url, $request_path, $is_ajax;
    public $config;
    public $admin_url, $site_url, $admin_dir_name;

    public $controller_name = '';
    public $action = '';
    public $params = array();
    public $controller_class = '';

    function __construct( $config, $base_request_url = null, $request_path = null, $is_ajax = null ) {
        if ( is_null( $base_request_url ) ) $base_request_url = self::base_request_url();
        if ( is_null( $request_path ) ) $request_path = $_SERVER['REQUEST_URI'];
        if ( is_null( $is_ajax ) ) $is_ajax = isset( $_REQUEST['ajax'] );

        $this->base_request_url = $base_request_url;
        $this->request_path = $request_path;
        $this->request_url = $base_request_url . $request_path;
        $this->config = $config;
        $this->is_ajax = $is_ajax;

        $this->set_urls();
        $this->parse_request_url();
        $this->set_controller_class();
    }

    private function set_urls() {
        $admin_path = str_replace( '/index.php', '', $_SERVER['SCRIPT_NAME'] );
        $root_path = substr( $admin_path, 0, strrpos( $admin_path, '/' ) );

        $this->admin_url = $this->base_request_url . $admin_path;
        $this->site_url = $this->base_request_url . $root_path;

        $this->admin_dir_name = substr( $admin_path, strrpos( $admin_path, '/' )+1 );
    }

    function admin_url( $path = '' ) {
        return $this->admin_url . '/' . ltrim( $path, '/' );
    }

    function site_url( $path = '' ) {
        return $this->site_url . '/' . ltrim( $path, '/' );
    }

    function get_template_url( $template, $url = '' ) {
        return $this->admin_url( 'templates/' . rawurlencode( $template ) . '/' . ltrim( $url, '/' ) );
    }

    function get_uploads_url( $url = '' ) {
        return $this->admin_url( 'uploads/' . ltrim( $url, '/' ) );
    }

    private function parse_request_url() {
        $admin_url = parse_url( $this->admin_url );
        $request_url = parse_url( $this->request_url );

        $path = preg_replace( '@^' . $admin_url['path'] . '@', '', $request_url['path'] );
        $path = strtolower( trim( $path, '/' ) );
        $path = str_replace( '..', '', $path );

        if ( !$path ) return;

        $segments = explode( '/', $path );

        $this->controller_name = array_shift( $segments );
        $this->controller_name = preg_replace( '@[^a-z0-9/\-_\.]@', '', $this->controller_name );

        if ( !$segments ) return;
        
        $this->action = array_shift( $segments );
        $this->action = preg_replace( '@[^a-z0-9/\-_\.]@', '', $this->action );
        $this->action = preg_replace( '@[/\-\.]@', '_', $this->action );

        // if the function starts with an underscore, 
        // it can't be called as a controller action
        if ( '_' == substr( $this->action, 0, 1 ) ) {
            $this->action = '';
        }

        $this->params = $segments;
        foreach ( $this->params as $i => $param ) {
            $this->params[$i] = urldecode( $param );
        }
    }
    
    private function set_controller_class() {
        $name = $this->controller_name;
        $namespace = '\\Leeflets\\Controller\\';

        if ( !$name && !$this->action ) {
            $this->controller_name = 'home';
            $this->controller_class = $namespace . 'Home';
            $this->action = 'index';
            return;
        }

        $name = preg_replace( '@[/\-\.]@', '_', $name );
        $class = $namespace . String::camelize( $name );

        $path = File::get_class_file_path( $this->config, ltrim( $class, '\\' ) );
        if ( !file_exists( $path ) || !method_exists( $class, $this->action ) ) {
            $this->controller_name = 'error';
            $this->controller_class = $namespace . 'Error';
            $this->action = 'e404';
        }
        else {
            $this->controller_class = $class;
        }
    }

    static function base_request_url() {
        $ssl = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on' ) ? 's' : '';
        $port = ( $_SERVER['SERVER_PORT'] != '80'  ) ? ':' . $_SERVER['SERVER_PORT'] : '';
        return sprintf('http%s://%s%s', $ssl, $_SERVER['SERVER_NAME'], $port );
    }

    static function redirect( $url, $status = 302 ) {
        header( 'Location: ' . $url, true, $status );
    }
}
