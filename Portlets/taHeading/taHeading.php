<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taHeading;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class Heading
 * @package JTL\OPC\Portlets
 */
class taHeading extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'leveltag' => [
                'label'      => __('leveltag'),
                'type'       => InputType::SELECT,
                'options'    => [
                    'h' => 'h',
                    'span' => 'span',
                    'strong' => 'strong',
                    'div' => 'div'
                ],
                'default'    => '1',
                'required'   => true,
                'width'      => 17,
            ],
            'level' => [
                'label'      => __('level'),
                'type'       => InputType::SELECT,
                'options'    => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                    6 => '6'
                ],
                'default'    => '2',
                'required'   => true,
                'width'      => 17,
                'desc'      => __('levelDesc')
            ],
            'text'  => [
                'label'      => __('heading'),
                'type'       => InputType::TEXT,
                'default'    => __('Heading'),
                'width'      => 40,
            ],
            'align' => [
                'label'      => __('alignment'),
                'type'       => InputType::SELECT,
                'default'    => 'left',
                'options'    => [
                    'inherit'=> __('inherit'),
                    'left'   => __('left'),
                    'center' => __('centered'),
                    'right'  => __('right'),
                ],
                'desc'       => __('alignmentDesc'),
                'width'      => 25,
            ],
            'anker'  => [
                'label'      => __('ankername'),
                'type'       => InputType::TEXT,
                'width'      => 30,
            ],
            'url'  => [
                'label'      => __('url'),
                'type'       => InputType::TEXT,
                'width'      => 30,
            ],
        ];
    }

    /**
     * @return array
     */
    public function getPropertyTabs(): array
    {
        return [
            __('Styles')    => 'styles',
            __('Animation') => 'animations',
        ];
    }
}
