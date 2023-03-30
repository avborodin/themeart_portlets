<?php

use Illuminate\Support\Collection;
use JTL\Shop;
use JTL\Plugin\Helper;
use JTL\Plugin\Plugin;
use JTL\Filter\Config;
use JTL\Session\Frontend;
use JTL\Filter\ProductFilter;

function lightsearch($keyword): array
{
	$minLength 	= ($cnt = Shop::getSettingValue(\CONF_ARTIKELUEBERSICHT, 'suche_min_zeichen')) > 0 ? $cnt : 4;
	$results = [];
	if (\mb_strlen($keyword) < $minLength) {
		return $results;
	}

	$smarty  = Shop::Smarty();
	$plugin  = Helper::getPluginById("themeart_portlets");

	Shop::setPageType(PAGE_ARTIKELLISTE);
	$conf = Config::getDefault();
	$NaviFilter = new ProductFilter($conf, Shop::Container()->getDB(), Shop::Container()->getCache());
	$param['cSuche'] = $keyword;

	$smarty->assign('NettoPreise', Frontend::getCustomerGroup()->getIsMerchant())
		->assign('settings', $plugin->getConfig());

	$NaviFilter->initStates($param);
	$AktuelleKategorie = new Kategorie();
	$NaviFilter->setUserSort($AktuelleKategorie);
	$resultSearch = $NaviFilter->generateSearchResults($AktuelleKategorie);
	$data = [];
	
	foreach ($resultSearch->getProducts() as $Artikel){
		$obj = new stdClass();
		$obj->keyword = $Artikel->cName;
		$obj->suggestion = $smarty->assign('result', $Artikel)
			->fetch($plugin->getPaths()->getFrontendPath() . 'template/themeart_lightsearch/suggestion.tpl');
		$data[] = $obj;
	}

	return $data;
}