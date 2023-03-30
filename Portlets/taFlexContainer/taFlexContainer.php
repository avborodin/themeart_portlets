<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taFlexContainer;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class taFlexContainer
 */
class taFlexContainer extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'min-height'      => [
                'type'    => InputType::NUMBER,
                'label'   => __('minHeightPX'),
                'width'   => 35,
            ],
            'cssclass'      => [
                'type'    => InputType::TEXT,
                'label'   => __('cssClass'),
                'width'   => 35,
            ],
            'boxed' => [
                'label'      => __('flexContainer'),
                'type'       => InputType::SELECT,
                'default'    => 'boxed',
                'options'    => [
                    'boxed'   => __('boxedContainer'),
                    'plain' => __('plainContainer'),
                ],
                'desc'       => __('containerDesc'),
                'width'      => 30,
            ],
            'background-flag' => [
                'type'    => InputType::RADIO,
                'label'   => __('background'),
                'options' => [
                    'still' => __('image'),
                    'image' => __('imageParallax'),
                    'video' => __('backgroundVideo'),
                    'false' => __('noBackground'),
                ],
                'default' => 'false',
                'width'   => 50,
                'childrenFor' => [
                    'still' => [
                        'still-src'  => [
                            'label' => __('backgroundImage'),
                            'type'  => InputType::IMAGE,
                        ],
                    ],
                    'image' => [
                        'src'  => [
                            'label' => __('backgroundImage'),
                            'type'  => InputType::IMAGE,
                        ],
                    ],
                    'video' => [
                        'video-src' => [
                            'type'  => InputType::VIDEO,
                            'label' => __('video'),
                            'width' => 50,
                        ],
                        'video-poster' => [
                            'type'  => InputType::IMAGE,
                            'label' => __('placeholderImage'),
                            'width' => 50,
                        ],
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
            __('Styles')    => 'styles',
            __('Animation') => 'animations',
        ];
    }
}
