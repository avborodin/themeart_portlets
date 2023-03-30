<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taBrandSlider;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class BrandSlider
 */
class taBrandSlider extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        $desc = [
            'slider-to-show-xl'      => [
                'label'      => __('sliderToShowXl'),
                'type'       => InputType::NUMBER,
                'default'    => 6,
                'width'      => 25,
            ],
            'slider-to-show-lg'      => [
                'label'      => __('sliderToShowLg'),
                'type'       => InputType::NUMBER,
                'default'    => 4,
                'width'      => 25,
            ],
            'slider-to-show-md'      => [
                'label'      => __('sliderToShowMd'),
                'type'       => InputType::NUMBER,
                'default'    => 3,
                'width'      => 25,
            ],
            'slider-to-show-sm'      => [
                'label'      => __('sliderToShowSm'),
                'type'       => InputType::NUMBER,
                'default'    => 2,
                'width'      => 25,
            ],
            'slider-centermode'                => [
                'label'      => __('centerMode'),
                'type'       => InputType::RADIO,
                'options'    => [
                    'true'  => __('yes'),
                    'false' => __('no'),
                ],
                'default'    => 'true',
                'inline'     => true,
                'width'      => 25,
            ],
            'slider-animation-speed'      => [
                'label'      => __('sliderAnimationSpeed'),
                'type'       => InputType::NUMBER,
                'default'    => 300,
                'width'      => 25,
            ],
            'slider-start'                => [
                'label'      => __('autoStart'),
                'type'       => InputType::RADIO,
                'options'    => [
                    'true'  => __('yes'),
                    'false' => __('no'),
                ],
                'default'    => 'true',
                'inline'     => true,
                'width'      => 25,
            ],
            'slider-pause'                => [
                'label'      => __('pauseOnHover'),
                'type'       => InputType::RADIO,
                'options'    => [
                    'true'  => __('yes'),
                    'false' => __('no'),
                ],
                'default'    => 'false',
                'width'      => 25,
            ],
            'slider-navigation'           => [
                'label'      => __('pointNavigation'),
                'type'       => InputType::RADIO,
                'options'    => [
                    'true'  => __('yes'),
                    'false' => __('no'),
                ],
                'default'    => 'false',
                'width'      => 25,
            ],
            'slider-direction-navigation' => [
                'label'      => __('showNavigationArrows'),
                'type'       => InputType::RADIO,
                'options'    => [
                    'true'  => __('yes'),
                    'false' => __('no'),
                ],
                'default'    => 'false',
                'width'      => 25
            ],
            'slides'                      => [
                'label'      => __('images'),
                'type'       => InputType::IMAGE_SET,
                'default'    => [],
                'useLinks'   => true,
                'useTitles'  => true,
            ],
        ];

        return $desc;
    }

    /**
     * @return array
     */
    public function getPropertyTabs(): array
    {
        return [
            __('Slides') => ['slides'],
            __('Styles') => 'styles',
        ];
    }
}
