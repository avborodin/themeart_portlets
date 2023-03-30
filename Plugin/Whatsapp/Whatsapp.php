<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin\Whatsapp;

use JTL\Shop;

class Whatsapp 
{
	private $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
    }

	public function getButton() {

		$plugin = $this->plugin;
		$whatsappNumber = $plugin->getConfig()->getValue('whatsappNumber');

		$smarty = Shop::Smarty();

		$html = $smarty->assign('whatsappNumber', $whatsappNumber)
			->fetch($plugin->getPaths()->getFrontendPath() . 'template/themeart_whatsapp/button.tpl');	

		pq('body')->append($html);
	}
}