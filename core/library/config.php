<?php
class LF_Config {
	public $path, $username, $password, $debug, $fs_method;
	public $admin_path, $root_path, $core_path, $controller_path, $library_path, $view_path, $theme_path, $form_path;
	public $is_loaded = false;

	function __construct( $admin_path ) {
		$this->admin_path = $admin_path;
		$this->root_path = realpath( $this->admin_path . '/../' );
		$this->core_path = $this->admin_path . '/core';
		$this->controller_path = $this->core_path . '/controller';
		$this->library_path = $this->core_path . '/library';
		$this->view_path = $this->core_path . '/view';
		$this->theme_path = $this->core_path . '/theme';
		$this->form_path = $this->core_path . '/form';
		$this->third_party_path = $this->core_path . '/third-party';

		$this->templates_path = $this->admin_path . '/templates';
		$this->data_path = $this->admin_path . '/data';
		$this->uploads_path = $this->admin_path . '/uploads';

		$this->path = $this->admin_path . '/config.php';
	}

	function load() {
		if ( !file_exists( $this->path ) ) return false;
		require $this->path;

		$required = array( 'username', 'password' );
		foreach ( $required as $var ) {
			if ( is_null( $this->$var ) ) die( 'Missing ' . $var . ' from config.php.' );
		}

		$this->is_loaded = true;

		return true;
	}
	
	function write( LF_Filesystem_Direct $fs, $data ) {
		if ( file_exists( $this->path ) ) return false;

		$out = "<?php\n";

		foreach ( $data as $key => $value ) {
			$out .= "\$this->" . $key . " = '" . addslashes( $value ) . "';\n";
		}
		
		return $fs->put_contents( $this->path, $out );
	}

}
