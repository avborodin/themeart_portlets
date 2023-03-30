<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taGooglemap;

use JTL\OPC\Portlet;

class taGooglemap extends Portlet
{
	/**
	 * @return array
	 */
	public function getPropertyDesc(): array
	{
		return [
			'gmap_address'  => [
				'label' => __('gmap_address'),
				'type' => 'text',
				'default' => '',
			],
			'gmap_key' => [
				'label' => __('gmap_key'),
				'type' => 'text',
				'default' => '',
			],
			'height' => [
				'label' => __('gmap_height'),
				'type' => 'text',
				'width'   => 40,
				'default' => '400',
			],
			'documentation' => [
				'label' => __('documentation'),
				'type' => 'hidden',
				'default' => 'https://docs.themeart.de/article/231-google-map-portlet-jtl-shop-5'
			],
		];
	}

	/**
	 * @return array
	 */
	public function getPropertyTabs(): array
	{
		return [
			__('Styles') => 'styles',
			__('Documentation') => ['documentation']
		];
	}
}
