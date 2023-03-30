<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taImage;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class taImage
 */
class taImage extends Portlet
{
    /**
     * @param PortletInstance $instance
     * @return bool|string
     */
    public function getRoundedProp(PortletInstance $instance)
    {
        switch ($instance->getProperty('shape')) {
            case 'rounded':
                return true;
            case 'circle':
                return 'circle';
            case 'normal':
            default:
                return false;
        }
    }

    /**
     * @param PortletInstance $instance
     * @return bool
     */
    public function getThumbnailProp(PortletInstance $instance): bool
    {
        return $instance->getProperty('shape') === 'thumbnail';
    }

    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'src'        => [
                'label'   => \__('Image'),
                'type'    => InputType::IMAGE,
                'default' => '',
            ],
            'shape'      => [
                'label'      => \__('shape'),
                'type'       => InputType::SELECT,
                'options'    => [
                    'normal'    => \__('shapeNormal'),
                    'rounded'   => \__('shapeRoundedCorners'),
                    'circle'    => \__('shapeCircle'),
                    'thumbnail' => \__('shapeThumbnail'),
                ],
                'width' => 25,
            ],
            'align' => [
                'type'       => InputType::SELECT,
                'label'      => \__('alignment'),
                'options'    => [
                    'center' => \__('centered'),
                    'left'   => \__('left'),
                    'right'  => \__('right'),
                ],
                'default'    => 'center',
                'width'      => 25,
                'desc'       => \__('alignmentDesc')
            ],
            'alt'        => [
                'label' => \__('alternativeText'),
                'width'      => 50,
            ],
            'max-width'        => [
                'label' => \__('maxWidth'),
                'width'      => 25,
                'desc'       => \__('maxWidthDesc')
            ],
            'max-height'        => [
                'label' => \__('maxHeight'),
                'width'      => 25,
                'desc'       => \__('maxHeightDesc')
            ],
            'is-link' => [
                'type'     => InputType::CHECKBOX,
                'label'    => \__('isLink'),
                'children' => [
                    'url' => [
                        'type'  => InputType::TEXT,
                        'label' => \__('url'),
                        'width' => 50,
                        'desc'  => \__('imgUrlDesc')
                    ],
                    'link-title' => [
                        'label'      => \__('linkTitle'),
                        'width'      => 50,
                    ],
                    'new-tab' => [
                        'type'       => InputType::CHECKBOX,
                        'label'      => \__('openInNewTab'),
                        'width'      => 50,
                        'desc'       => \__('openInNewTabDesc')
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
            \__('Styles') => 'styles',
            __('Animation') => 'animations',
        ];
    }
}
