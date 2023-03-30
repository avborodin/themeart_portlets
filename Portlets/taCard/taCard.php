<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taCard;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class taCard
 */
class taCard extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'src'        => [
                'label'   => __('Image'),
                'type'    => InputType::IMAGE,
                'default' => '',
                'width'   => 40,
            ],
            'alt'        => [
                'label' => __('alternativeText'),
                'width'   => 25,
            ],
            'link' => [
				'label' => __('link'),
				'type' => 'text',
                'default' => '#',
                'width'   => 35,
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
            __('Animation') => 'animations',
        ];
    }


}
