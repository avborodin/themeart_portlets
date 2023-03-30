<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taIcon;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class taIcon
 */
class taIcon extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'label' => [
                'label'     => __('title'),
                'default'   => __('defaultText'),
                'desc'      => __('titleDesc'),
                'width'     => 32,
            ],
            'url' => [
                'label' => __('url'),
                'width' => 50,
            ],
            'size' => [
                'label' => __('size'),
                'default'   => __('20px'),
                'width' => 15,
                'desc' => __('sizeDesc')
            ],
            'new-tab' => [
                'type'       => InputType::CHECKBOX,
                'label'      => __('openInNewTab'),
                'width'      => 50,
                'desc'       => __('openInNewTabDesc')
            ],
            'use-icon' => [
                'type'     => InputType::CHECKBOX,
                'label'    => __('iconForButton'),
                'children' => [
                    'icon' => [
                        'type'  => InputType::ICON,
                        'label' => __('Icon'),
                    ],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getPropertyTabs(): array
    {
        return [
            'Icon'      => [
                'use-icon',
            ],
            __('Styles')    => 'styles',
            __('Animation') => 'animations',
        ];
    }
}
