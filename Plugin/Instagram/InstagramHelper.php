<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin\Instagram;

use JTL\Plugin\PluginInterface;
use JTL\DB\DbInterface;
use JTL\Shop;
use stdClass;

class InstagramHelper
{
	const API_URL = "https://token-v2.themeart.de/";
	const API_REFRESH_URL = "https://token-v2.themeart.de/api/update_token.php";
	const TABLE = "xplugin_themeart_portlet_settings";

	public function __construct(PluginInterface $plugin)
	{
		$this->plugin = $plugin;
	}

	public function getToken()
	{
		$res = \Shop::Container()->getDB()->select(self::TABLE, "key", "ig_token");
		return $res->value;
	}

	public function getExpireToken()
	{
		$res = \Shop::Container()->getDB()->select(self::TABLE, "key", "ig_time_expire_token");
		return $res->value;
	}

	public function updateSetting($key, $value)
	{
		$obj = new stdClass();
		$obj->value = $value;
		\Shop()::Container()->getDB()->update(self::TABLE, 'key', $key, $obj);
	}

	public function refreshToken($token)
	{
		$params = array(
			'token' => $token
		);
		$paramString = null;

		if (isset($params) && is_array($params)) {
			$paramString = '?' . http_build_query($params);
		}

		$apiURL = self::API_URL . $paramString;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiURL);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_TIMEOUT_MS, 90000);

		$jsonData = curl_exec($ch);

		if (!$jsonData) {
			return 'Error: cURL error: ' . curl_error($ch);
		}

		curl_close($ch);

		return json_decode($jsonData);
	}

	public function getForm()
	{
		$plugin_id = $this->plugin->getID();
		$redirect_uri = \Shop()::getURL()."/admin/plugin.php?kPlugin=".$plugin_id;
		$tplPath = $this->plugin->getPaths()->getAdminPath() . 'templates/';

		return \Shop::Smarty()
			->assign('api_url', self::API_URL)
			->assign('redirect_uri',$redirect_uri)
			->assign('jtl_token_',$_SESSION["jtl_token"])
			->assign('tokenFromSetting',$this->getToken())
			->assign('plugin_id', $plugin_id)
			->fetch($tplPath . 'instagram.tpl');
	}
}