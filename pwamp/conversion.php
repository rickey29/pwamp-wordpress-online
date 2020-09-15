<?php
if ( !defined('ABSPATH') )
{
	exit;
}

require_once plugin_dir_path( __FILE__ ) . 'cfg.php';
require_once plugin_dir_path( __FILE__ ) . 'flx.php';

class PWAMPConversion
{
	public function __construct()
	{
	}

	public function __destruct()
	{
	}


	public function convert($page, $home_url, $data, $theme, $plugins)
	{
		$flx = new Flx();

		$flx->base64_encode($page);

		$request = array(
			'page' => $page,
			'home_url' => $home_url,
			'data' => $data,
			'theme' => $theme,
			'plugins' => $plugins
		);

		$response = $flx->query(FLX_PWAMP, $request);
		if ( empty($response) )
		{
			return '';
		}

		if ( !isset($response['page']) || !is_string($response['page']) )
		{
			return '';
		}
		$page = $response['page'];

		$flx->base64_decode($page);

		return $page;
	}
}
