<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taButton;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class Button
 * @package JTL\OPC\Portlets
 */
class taButton extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'label' => [
                'label'   => __('label'),
                'default' => __('clickMe'),
                'width'   => 50,
            ],
            'style' => [
                'type'    => InputType::SELECT,
                'label'   => __('style'),
                'default' => 'primary',
                'options' => [
                    '' => __('styleNon'),
                    'primary' => __('stylePrimary'),
                    'secondary' => __('styleSecondary'),
                    'light' => __('styleLight'),
                    'success' => __('styleSuccess'),
                    'info'    => __('styleInfo'),
                    'warning' => __('styleWarning'),
                    'danger'  => __('styleDanger'),
                    'link'  => __('styleLink'),
                ],
                'width'   => 25,
            ],
            'size' => [
                'type'       => InputType::SELECT,
                'label'      => __('size'),
                'default'    => 'md',
                'options'    => [
                    'sm' => 'S',
                    'md' => 'M',
                    'lg' => 'L',
                ],
                'width' => 25,
            ],
            'url' => [
                'label' => __('url'),
                'width' => 50,
            ],
            'align' => [
                'type'       => InputType::SELECT,
                'label'      => __('alignment'),
                'options'    => [
                    'block'  => __('useFullWidth'),
                    'left'   => __('left'),
                    'right'  => __('right'),
                    'center' => __('centered'),
                ],
                'default'    => 'block',
                'width'      => 25
            ],
            'new-tab' => [
                'type'       => InputType::CHECKBOX,
                'label'      => __('openInNewTab'),
                'width'      => 25
            ],
            'btn-outline' => [
                'type'       => InputType::CHECKBOX,
                'label'      => __('btnOutline'),
                'width'      => 25,
                'desc'       => __('btnOutlineDesc')
            ],
            'inline' => [
                'type'       => InputType::CHECKBOX,
                'label'      => __('btnInline'),
                'width'      => 30,
                'desc'       => __('btnInlineDesc')
            ],
            'use-icon' => [
                'type'     => InputType::CHECKBOX,
                'label'    => __('iconForButton'),
                'children' => [
                    'icon-align'    => [
                        'type'    => InputType::SELECT,
                        'label'   => __('alignment'),
                        'width' => 50,
                        'options' => [
                            'left'  => __('left'),
                            'right' => __('right'),
                            'center' => __('center')
                        ],
                    ],
                    'iconsize' => [
                        'label' => __('size'),
                        'width' => 50,
                    ],
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
