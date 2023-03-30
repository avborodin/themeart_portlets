<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taInstagramFeed;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;
use JTL\helpers\Request;
use JTL\Shop;

class taInstagramFeed extends Portlet
{
	private function getTemplatePath()
	{
		return $this->getBasePath() . "template/";
	}

	public function getFinalHtml(PortletInstance $instance, bool $inContainer = true): string
	{
		$template = $instance->getProperty("template");
		$number   = $instance->getProperty("number");
		$tplPath  = $this->getTemplatePath();
		
		$iconInstagram = '<svg class="eapps-instagram-feed-item-source-link-icon" viewBox="0 0 24 24" width="24" height="24"><path d="M17.1,1H6.9C3.7,1,1,3.7,1,6.9v10.1C1,20.3,3.7,23,6.9,23h10.1c3.3,0,5.9-2.7,5.9-5.9V6.9C23,3.7,20.3,1,17.1,1zM21.5,17.1c0,2.4-2,4.4-4.4,4.4H6.9c-2.4,0-4.4-2-4.4-4.4V6.9c0-2.4,2-4.4,4.4-4.4h10.3c2.4,0,4.4,2,4.4,4.4V17.1z"></path><path d="M16.9,11.2c-0.2-1.1-0.6-2-1.4-2.8c-0.8-0.8-1.7-1.2-2.8-1.4c-0.5-0.1-1-0.1-1.4,0C10,7.3,8.9,8,8.1,9S7,11.4,7.2,12.7C7.4,14,8,15.1,9.1,15.9c0.9,0.6,1.9,1,2.9,1c0.2,0,0.5,0,0.7-0.1c1.3-0.2,2.5-0.9,3.2-1.9C16.8,13.8,17.1,12.5,16.9,11.2zM12.6,15.4c-0.9,0.1-1.8-0.1-2.6-0.6c-0.7-0.6-1.2-1.4-1.4-2.3c-0.1-0.9,0.1-1.8,0.6-2.6c0.6-0.7,1.4-1.2,2.3-1.4c0.2,0,0.3,0,0.5,0s0.3,0,0.5,0c1.5,0.2,2.7,1.4,2.9,2.9C15.8,13.3,14.5,15.1,12.6,15.4z"></path><path d="M18.4,5.6c-0.2-0.2-0.4-0.3-0.6-0.3s-0.5,0.1-0.6,0.3c-0.2,0.2-0.3,0.4-0.3,0.6s0.1,0.5,0.3,0.6c0.2,0.2,0.4,0.3,0.6,0.3s0.5-0.1,0.6-0.3c0.2-0.2,0.3-0.4,0.3-0.6C18.7,5.9,18.6,5.7,18.4,5.6z"></path></svg>';
		
		$iconLike = '<svg width="24" height="24" viewBox="0 0 24 24"><path 0,0-0.4,0.4-0.7,0.7c-0.3-0.3-0.7-0.7-0.7-0.7c-1.6-1.6-3-2.1-5-2.1C2.6,1.5,0,4.6,0,8.3c0,4.2,3.4,7.1,8.6,11.5c0.9,0.8,1.9,1.6,2.9,2.5c0.1,0.1,0.3,0.2,0.5,0.2s0.3-0.1,0.5-0.2c1.1-1,2.1-1.8,3.1-2.7c4.8-4.1,8.5-7.1,8.5-11.4C24,4.6,21.4,1.5,17.7,1.5z M14.6,18.6c-0.8,0.7-1.7,1.5-2.6,2.3c-0.9-0.7-1.7-1.4-2.5-2.1c-5-4.2-8.1-6.9-8.1-10.5c0-3.1,2.1-5.5,4.9-5.5c1.5,0,2.6,0.3,3.8,1.5c1,1,1.2,1.2,1.2,1.2C11.6,5.9,11.7,6,12,6.1c0.3,0,0.5-0.2,0.7-0.4c0,0,0.2-0.2,1.2-1.3c1.3-1.3,2.1-1.5,3.8-1.5c2.8,0,4.9,2.4,4.9,5.5C22.6,11.9,19.4,14.6,14.6,18.6z"></path></svg>';

		$fields = 'id,ig_id,media_type,media_url,thumbnail_url,timestamp,permalink,caption,like_count,comments_count,username';
		
		if(!$this->getToken()){
			return '';
		}
		$url = 'https://graph.instagram.com/v12.0/me/media?access_token='.$this->getToken().'&fields='.$fields.'&limit='.$number;
		
		$instagrams = Request::make_http_request($url);
		$instagrams = json_decode($instagrams);
		
		$smarty   = Shop::Smarty()
			->assign('instagrams', $instagrams->data)
			->assign('iconInstagram',$iconInstagram)
			->assign('iconLike',$iconLike);
		return $smarty->fetch($tplPath . $template . ".tpl");
	}

	public function getPropertyDesc(): array
	{
		return [
			'template' => [
				'type'    => InputType::SELECT,
				'label'   => __('Select template'),
				'width'   => 30,
				'order'   => 2,
				'options' => $this->getTemplates(),
				'default' => 'grid',
			],
			'number' => [
				'type' => InputType::TEXT,
				'label' => __('Number'),
				'placeholder' => '20',
				'width' => 30,
				'order' => 5,
				'default' => 20,
			]
		];
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
	
	public function getToken()
	{
		$res = Shop::Container()->getDB()->select("xplugin_themeart_portlet_settings", "key", "ig_token");
		return $res->value;
	}

	private function getTemplates()
	{
		$tplPath = $this->getTemplatePath();

		$templates = [];

		if(file_exists($tplPath)) {
			$files = array_diff(scandir($tplPath), array('..', '.'));
			array_walk(
				$files,
				function($v) use (&$templates) {
					$k = str_replace(".tpl", "", $v);
					$templates[$k] = ucfirst(str_replace("_", " ", $k));
				}
			);
		}

		return $templates;
	}
}