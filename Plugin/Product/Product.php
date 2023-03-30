<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin\Product;

use JTL\Shop;

class Product 
{
	private $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

	public function getStockInfo()
	{	
		if(\Shop()::getPageType()!==\PAGE_ARTIKEL) {
            return null;
        }

		$plugin   = $this->plugin;
		$selector = $plugin->getConfig()->getValue('selectorProductStock');

		if(empty($selector)){
        	return null;
        }

       	$smarty   = Shop::Smarty();
		$conf     = Shop::getSettings([\CONF_GLOBAL]);

		$article = $smarty->getTemplateVars("Artikel");

		$textTranslation = $plugin->getLocalization()->getTranslation('text-lagerbestand');
		$noticeStock = sprintf($textTranslation, '<span class="status status-' . $article->Lageranzeige->nStatus . '">' . $article->fLagerbestand . ' ' . $article->cEinheit . '</span>');

		$html = $smarty->assign('conf', $conf)
			->assign("noticeStock", $noticeStock)
			->fetch($plugin->getPaths()->getFrontendPath() . 'template/product/stockInfo.tpl');	

		pq($selector)->before($html);
	}
	public function setInfiniteScroll()
	{
		if(\Shop()::getPageType()!==\PAGE_ARTIKELLISTE) {
            return null;
        }
		$plugin   = $this->plugin;
		$loadInfiniteScroll = $plugin->getConfig()->getValue('loadInfiniteScroll');
		$smarty   = Shop::Smarty();
		$html     = $smarty->assign('loadInfiniteScroll',$loadInfiniteScroll)
			->fetch($plugin->getPaths()->getFrontendPath() . 'template/product/infinite_scroll.tpl');			
		
		pq('#result-wrapper')->append($html);
	}
}