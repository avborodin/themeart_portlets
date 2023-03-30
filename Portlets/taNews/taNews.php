<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taNews;

use Illuminate\Support\Collection;
use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;
use JTL\Shop;
use JTL\Shopsetting;
use JTL\News\ItemList;
use JTL\News\Controller;
use JTL\News\Category;
use Locale;
use stdClass;


class taNews extends Portlet
{
	public function getPropertyDesc(): array
	{
		return [
			'Сategory' => [
				'type' => InputType::SELECT,
				'label' => __('TaNewsСategory'),
				'options' => $this->getTree(),
				'width' => 30,
				'order' => 1
			],
		];
	}

	public function getPropertyTabs(): array
	{
		return [
			__('Styles')	=> 'styles',
			__('Animation') => 'animations',
		];
	}

	public function getTree()
	{
		$db           = Shop::Container()->getDB();
		$conf         = Shopsetting::getInstance()->getAll();
		$smarty       = Shop::Smarty();
		$controller	  = new Controller($db, $conf, $smarty);
		$categories	  = $controller->getAllNewsCategories(true);
		$data = [];
		if(!Shop::isFrontend()) {	
			$data = $this->doRecursive($categories);
		}
		return $data;
	}

	public function getNewsByCategory(PortletInstance $instance)
	{
		$category  = $instance->getProperty("Сategory");
		$cNewsKatSQL = '';
		if($category){
			$cNewsKatSQL = ' AND tnewskategorie.kNewsKategorie ='.(int)$category;
		}
		
		$smarty           = Shop::Smarty();
		$category         = new Category(Shop::Container()->getDB());
		$sql              = new stdClass();
		$sql->cSortSQL    = '';
		$sql->cNewsKatSQL = $cNewsKatSQL;
		$sql->cDatumSQL   = '';
		$category->getOverview($sql);
		$items  = $category->filterAndSortItems(0, Shop::getLanguageID());
		$items = $items->forPage(0,4);
		return $items;

	}

	private function getShopLanguageByTag($languageTag)
	{
		$languageName = Locale::getDisplayLanguage($languageTag);
		$langObj = Shop::Container()->getDB()->select("tsprache", "cNameEnglisch", $languageName);
		if($langObj instanceof \stdClass) {
			return (int) $langObj->kSprache;
		}
		return Shop::getLanguageID();
	}
	
	private function doRecursive($categories)
	{	
		if(isset($_SESSION['AdminAccount']->language)){
			$language = $_SESSION['AdminAccount']->language;
		}
		$langID  = $this->getShopLanguageByTag($language);
		
		$data  = [];
		foreach($categories as $r){
			$data[$r->getID()] = str_repeat('- ', (int)$r->getLevel()) . ' ' . $r->getName($langID);
			if($r->getChildren()->count() > 0){
				$dataChild = $this->doRecursive($r->getChildren());
				$data = $data + $dataChild;
			}
		}
		return $data;
	} 
}