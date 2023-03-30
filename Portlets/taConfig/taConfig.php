<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taConfig;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;

class taConfig extends Portlet
{
	/**
	 * @return array
	 */
	public function getPropertyDesc(): array
	{
		return [
			"categoryProductVariations" => [
				'label' => __('Category Product Variations'),
				'type' => InputType::SELECT,
				'options' => [
					'yes' => __('Yes'),
					'no' => __('No')
				],
				'default' => 'no',
			]
		];
	}
}