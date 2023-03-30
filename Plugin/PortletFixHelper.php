<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin;

use JTL\DB\ReturnType;
use JTL\Plugin\Helper;
use JTL\Plugin\Plugin;
use JTL\Plugin\PluginInterface;
use JTL\XMLParser;

class PortletFixHelper
{
	private $plugin;
	private $group = "themeart";

	public function __construct(PluginInterface $plugin)
	{
		$this->plugin = $plugin;
	}

	private function installPortlets()
	{
		if(file_exists($this->plugin->getPaths()->getBasePath() . \PLUGIN_INFO_FILE)) {
			$parser = new XMLParser();
			$xml = $parser->parse($this->plugin->getPaths()->getBasePath() . \PLUGIN_INFO_FILE);

			if(isset($xml["jtlshopplugin"][0]["Install"][0]["Portlets"][0]["Portlet"])) {
				$portlets = $xml["jtlshopplugin"][0]["Install"][0]["Portlets"][0]["Portlet"];

				foreach($portlets as $portlet) {
					if(
					!\Shop()::Container()->getDB()->select("topcportlet", [
							"cClass",
							"cGroup"
						],
							[
								$portlet["Class"],
								$portlet["Group"]
							])
						instanceof \stdClass
					) {
						$portletObj = new \stdClass();
						$portletObj->kPlugin = $this->plugin->getPluginID();
						$portletObj->cTitle = $portlet["Title"];
						$portletObj->cGroup = $portlet["Group"];
						$portletObj->bActive = $portlet["Active"];

						\Shop()::Container()->getDB()->insert("topcportlet", $portletObj);
					}
				}
			}
		}
	}

	public function fixDates()
	{
		$dbPages = \Shop()::Container()->getDB()->query("SELECT * FROM topcpage", ReturnType::ARRAY_OF_OBJECTS);

		foreach($dbPages as $dbPage) {
			$fieldsToFix = [];

			if($dbPage->dPublishTo === "0000-00-00 00:00:00") {
				$fieldsToFix[] = "dPublishTo = NULL";
			}

			if($dbPage->dLastModified === "0000-00-00 00:00:00") {
				$fieldsToFix[] = "dLastModified = NULL";
			}

			if($dbPage->dLockedAt === "0000-00-00 00:00:00") {
				$fieldsToFix[] = "dLockedAt = NULL";
			}

			if(is_array($fieldsToFix) && count($fieldsToFix)>0) {
				Shop()::Container()->getDB()->executeQuery(
					"UPDATE topcpage SET " . implode(", ", $fieldsToFix) . " WHERE kPage = " . $dbPage->kPage
				);
			}
		}
	}

	public function fix()
	{
		$this->installPortlets();

		$dbPortlets = \Shop()::Container()->getDB()->query("SELECT * FROM topcportlet", ReturnType::ARRAY_OF_OBJECTS);

		$portlets = [];

		foreach($dbPortlets as $dbPortlet) {
			$portlets[$dbPortlet->cClass]["portlet"] = $dbPortlet;
			$portlets[$dbPortlet->cClass]["group"] = $dbPortlet->cGroup===$this->group;
		}

		$pages = \Shop()::Container()->getDB()->query("SELECT * FROM topcpage", ReturnType::ARRAY_OF_OBJECTS);

		foreach($pages as $page) {
			$areas = \json_decode($page->cAreasJson, true);

			foreach($areas as $areaKey => &$area) {
				foreach($area["content"] as &$content) {
					$className = $this->getNewPortletClassName($content["class"]);

					if($className && isset($portlets[$className]["portlet"])) {
						if($portlets[$className]["group"]) {
							$content["class"] = $className;
							$content["id"] = (int) $portlets[$className]["portlet"]->kPortlet;
							$content["title"] = $portlets[$className]["portlet"]->cTitle;
						}
					}

					if(isset($content["subareas"])) {
						$this->recursivePageSubAreaFix($content["subareas"], $portlets);
					}
				}
			}

			$page->cAreasJson = \json_encode($areas);

			\Shop()::Container()->getDB()->update("topcpage", "kPage", $page->kPage, $page);
		}
	}

	public function portletClassFix()
	{
		return [
			strtolower("Slider") => "taSlider",
			strtolower("Button") => "taButton",
			strtolower("Card") => "taCard",
			strtolower("Product") => "taProduct",
			strtolower("ProductFeed") => "taProductFeed",
			strtolower("Googlemap") => "taGooglemap",
			strtolower("FlexContainer") => "taFlexContainer",
			strtolower("Heading") => "taHeading",
			strtolower("Faq") => "taFaq",
			strtolower("Icon") => "taIcon",
			strtolower("Gallery") => "taGallery",
			strtolower("Config") => "taConfig",
			strtolower("News") => "taNews",
			strtolower("Reviews") => "taReviews",
			strtolower("Navigation") => "taNavigation",
			strtolower("InstagramFeed") => "taInstagramFeed"
		];
	}

	public function getNewPortletClassName($oldPortletClassName)
	{
		$className = null;

		$isTitleFixed = substr(strtolower($oldPortletClassName), 0, 2) === "ta";

		if(!$isTitleFixed) {
			$className = "ta" . ucfirst($oldPortletClassName);
		}

		return $className;
	}

	public function checkIfSubAreaNeedsNewKey($key)
	{
		if(in_array(strtolower($key), array_keys($this->portletClassFix()))) {
			return true;
		}

		return false;
	}

	public function recursivePageSubAreaFix(&$subAreas, $portlets)
	{
		foreach($subAreas as $subareaKey => &$subArea) {
			if($this->checkIfSubareaNeedsNewKey($subArea["id"])) {
				$subarea["id"] = $this->portletClassFix()[strtolower($subArea["id"])];
			}

			foreach($subArea["content"] as $subAreaContentKey => &$subAreaContent) {
				$className = $this->getNewPortletClassName($subAreaContent["class"]);

				if($className) {
					if(isset($portlets[$className]["portlet"])) {
						if($portlets[$className]["group"]) {
							$subAreaContent["class"] = $className;
							$subAreaContent["id"] = (int) $portlets[$className]["portlet"]->kPortlet;
							$subAreaContent["title"] = $portlets[$className]["portlet"]->cTitle;
						}
					}
				}

				if(isset($subAreaContent["subareas"])) {
					$this->recursivePageSubAreaFix($subAreaContent["subareas"], $portlets);
				}
			}

			if($this->checkIfSubAreaNeedsNewKey($subareaKey)) {
				unset($subAreas[$subareaKey]);

				$newKeyName = $this->portletClassFix()[strtolower($subareaKey)];
				$subAreas[$newKeyName] = $subArea;
			}
		}
	}
}