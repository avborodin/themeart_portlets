<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taNavigation;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\Shop;
use JTL\OPC\PortletInstance;

/**
 * Class taNavigation
 */
class taNavigation extends Portlet
{
	public function getFinalHtml(PortletInstance $instance, bool $inContainer = true): string
	{
		$type 		= $instance->getProperty("navigationType");
		$linkHelper = Shop::Container()->getLinkService();

		if (Shop::$isInitialized === true) {
			$kLink = Shop::$kLink;
		}
		if($type == "subavigation"){
			$links = $linkHelper
				->getLinkByID($kLink)
				->getChildLinks();

		}elseif($type == "links"){
			$links = $linkHelper
				->getVisibleLinkGroups()
        		->getLinkgroupByTemplate($this->getGroupNameByLinkID($kLink))
        		->getLinks();
		}elseif($type == "anchor"){
			$links = null;
		}

		return \Shop::Smarty()
			->assign("instance", $instance)
			->assign('links', $links)
			->fetch($this->getBasePath()  . "taNavigation.tpl");  
	}

	public function getPropertyDesc(): array
	{
		return [
			'navigationType' => [
				'type' 	=> InputType::SELECT,
				'label' => __('taNavigationType'),
				'options' => [
					"subavigation" 	=> __('taNavigationSubNavigation'),
					"anchor" 		=> __('taNavigationAnchor'),
					"links" 		=> __('taNavigationLinks'),
				],
				'default' 	=> 'subavigation',
				'width' 	=> 40,
				'order' 	=> 1
			],
			'selector' => [
				'type' => InputType::TEXT,
				'label' => __('selector'),
				'placeholder' => '#content h2',
				'default' => '#content h2',
				'width' => 25,
				'order' => 2
			],
		];
	}

	private function getGroupNameByLinkID($linkID)
	{
		$groupAssocObj = Shop::Container()->getDB()->select("tlinkgroupassociations", "linkID", $linkID);
		$linkGroupObj = Shop::Container()->getDB()->select("tlinkgruppe", "kLinkgruppe", (int)$groupAssocObj->linkGroupID);
		
		return $linkGroupObj->cTemplatename;;
	}

	/**
     * @return array
     */
    public function getPropertyTabs(): array
    {
        return [
            __('Styles') => 'styles',
            __('Animation') => 'animations'
        ];
    }
}