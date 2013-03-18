<?php
namespace Leeflets\Library\Template;

class LF_Template_Code_Base {
	protected $is_publish, $config, $filesystem, $router,
		$content, $settings, $hook, $script, $style, $active_template;

	function __construct(
		$is_publish, LF_Config $config, LF_Filesystem $filesystem, LF_Router $router, 
		LF_Settings $settings, LF_Hook $hook, LF_Template_Scripts $script, 
		LF_Template_Styles $style, LF_Content $content
	) {
		$this->is_publish = $is_publish;
		$this->config = $config;
		$this->filesystem = $filesystem;
		$this->router = $router;
		$this->settings = $settings;
		$this->hook = $hook;
		$this->script = $script;
		$this->style = $style;
		$this->content = $content;

		$this->active_template = $this->settings->get( 'template', 'active' );

		$this->script->base_url = $this->style->base_url = $this->get_url();

		$this->setup_default_hooks();

		if ( method_exists( $this, 'setup_hooks' ) ) {
			$this->setup_hooks();
		}
	}

	// To be overriden by the template's LF_Template_Code
	function setup_hooks() {

	}

	function setup_default_hooks() {
		if ( !$this->is_publish ) {
			$url = $this->router->admin_url( '/core/theme/asset/js/frontend-edit.js' );
			$this->enqueue_script( 'lf-frontend-edit', $url, array( 'jquery' ) );

			if ( !$this->config->debug || !$this->settings->get( 'debug', 'disable-overlays' ) ) {
				$url = $this->router->admin_url( '/core/theme/asset/js/frontend-overlay.js' );
				$this->enqueue_script( 'lf-frontend-overlay', $url, array( 'jquery' ) );
				$url = $this->router->admin_url( '/core/theme/asset/css/frontend-overlay.css' );
				$this->enqueue_style( 'lf-frontend-overlay', $url );
			}
		}

		if ( trim( $this->settings->get( 'analytics', 'code' ) ) ) {
			$placement = $this->settings->get( 'analytics', 'placement' );
			$this->hook->add( $placement, array( $this, 'hook_insert_analytics' ) );
		}
	}

	public function hook_insert_analytics() {
		echo $this->settings->get( 'analytics', 'code' );
	}

	public function url( $url = '' ) {
		echo $this->get_url( $url );
	}

	public function get_url( $url = '' ) {
		return $this->router->get_template_url( $this->active_template, $url );
	}

	public function part( $file ) {
		echo $this->get_part( $file );
	}

	public function get_part( $file ) {
		ob_start();
		include $path = $this->config->templates_path . '/' . $this->active_template . '/part-' . $file . '.php';
		return ob_get_clean();
	}

    function enqueue_script( $handle, $src, $deps = array(), $ver = false, $args = null ) {
        $this->script->add_enqueue( $handle, $src, $deps, $ver, $args );
    }

    function enqueue_style( $handle, $src, $deps = array(), $ver = false, $args = null ) {
        $this->style->add_enqueue( $handle, $src, $deps, $ver, $args );
    }
}