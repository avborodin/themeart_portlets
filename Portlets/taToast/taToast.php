<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taToast;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class ImageLink
 * @package JTL\OPC\Portlets
 */
class taToast extends Portlet
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
     * @return string
     */
    public function getButtonHtml(): string
    {
        return $this->getFontAwesomeButtonHtml('fas fa-image');
    }

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
            ],
            'title' => [
				'label' => __('title'),
				'type' => 'text',
				'default' => 'Meine Kategorie',
            ],
            'desc' => [
				'label' => __('text'),
				'type' => 'text',
				'default' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr sed diam nonumy...',
            ],
            'button_text' => [
				'label' => __('button_text'),
				'type' => 'text',
				'default' => 'Mein Button',
			],
            'button_link' => [
				'label' => __('button_link'),
				'type' => 'text',
				'default' => '#',
			],
            'shape'      => [
                'label'      => __('shape'),
                'type'       => InputType::SELECT,
                'options'    => [
                    'normal'    => __('shapeNormal'),
                    'rounded'   => __('shapeRoundedCorners'),
                    'circle'    => __('shapeCircle'),
                    'thumbnail' => __('shapeThumbnail'),
                ],
                'width' => 50,
            ],
            'align' => [
                'type'       => InputType::SELECT,
                'label'      => __('alignment'),
                'options'    => [
                    'center' => __('centered'),
                    'left'   => __('left'),
                    'right'  => __('right'),
                ],
                'default'    => 'center',
                'width'      => 50,
                'desc'       => __('alignmentDesc')
            ],
            'alt'        => [
                'label' => __('alternativeText'),
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
        ];
    }
}
