<?php

use JTL\Extensions\Config\Group;
use JTL\Catalog\Product\Artikel;
use JTL\Helpers\Product;
use JTL\Plugin\Helper;
use JTL\IO\IOResponse;
use JTL\DB\ReturnType;
use JTL\Helpers\Text;
use JTL\Shop;

function loadConfigurationImage($params) {
	if($params["jtl_token"]!==$_SESSION["jtl_token"]) {
		return null;
	}

	$plugin = Helper::getPluginById("themeart_portlets");

	$image = null;
	$confItemId = (int) Text::filterXSS($params["value"]);
	$groupId = (int) Text::filterXSS($params["group"]);

	if($confItemId) {
		$configObj = Shop::Container()->getDB()->executeQueryPrepared(
			"SELECT tki.kArtikel
			FROM tkonfigitem as tki
			WHERE tki.kKonfigitem = :confItemId",
			[
				"confItemId" => $confItemId
			],
			ReturnType::SINGLE_OBJECT
		);

		if($configObj instanceof \stdClass) {
			$article = new Artikel();
			$articleId = (int) $configObj->kArtikel;

			$article->kArtikel = $articleId;
			$article->holBilder();

			Shop::Smarty()->assign("type", "article");
			Shop::Smarty()->assign("Einstellungen", Shopsetting::getInstance()->getAll());
			Shop::Smarty()->assign("configDescription", "5");
			Shop::Smarty()->assign("article", $article);
			$image = Shop::Smarty()->fetch($plugin->getPaths()->getFrontendPath() . "template/configgroupimage.tpl");
		}
	}

	if(!$image) {
		$articleId = $params["VariKindArtikel"] ?? $params['a'];
		$items = $params['item'] ?? [];
		$quantities = $params['quantity'] ?? [];
		$itemQuantities = $params['item_quantity'] ?? [];
		$variationValues = $params['eigenschaftwert'] ?? [];
		$amount = $params['anzahl'] ?? 1;

		$config = Product::buildConfig(
			$articleId,
			$amount,
			$variationValues,
			$items,
			$quantities,
			$itemQuantities,
			true
		);

		/**
		 * @var $configGroups Group[]
		 */
		$configGroups = $config->oKonfig_arr;

		if(is_array($configGroups) && count($configGroups)>0) {
			foreach($configGroups as $configGroup) {
				if($configGroup->getID()===$groupId) {
					$configDescription = $configGroup->getSprache()->hatBeschreibung() ? 0 : 5;

					Shop::Smarty()->assign("type", "config");
					Shop::Smarty()->assign("Einstellungen", Shopsetting::getInstance()->getAll());
					Shop::Smarty()->assign("configDescription", $configDescription);
					Shop::Smarty()->assign("config", $configGroup);
					$image = Shop::Smarty()->fetch($plugin->getPaths()->getFrontendPath() . "template/configgroupimage.tpl");

					break;
				}
			}
		}
	}

	$response = new IOResponse();
	$response->assignVar("image", trim($image));

	return $response;
}