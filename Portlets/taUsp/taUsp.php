<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taUsp;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class Usp
 * @package JTL\OPC\Portlets
 */
class taUsp extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'label' => [
                'label'   => __('label'),
                'default' => __('defaultText'),
                'width'   => 50,
            ],
            'subtitle' => [
                'label'      => __('subtitle'),
                'width'      => 50,
            ],
            'url' => [
                'label' => __('url'),
                'width' => 50,
            ],
            'new-tab' => [
                'type'       => InputType::CHECKBOX,
                'label'      => __('openInNewTab'),
                'width'      => 50,
                'desc'       => __('openInNewTabDesc')
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
                'default'    => 'left',
                'width'      => 50,
                'desc'       => __('alignmentDesc')
            ],
            'use-icon' => [
                'type'     => InputType::CHECKBOX,
                'label'    => __('iconForButton'),
                'children' => [
                    'icon-align'    => [
                        'type'    => InputType::SELECT,
                        'label'   => __('alignment'),
                        'options' => [
                            'top'  => __('top'),
                            'left'  => __('left'),
                            'right' => __('right')
                        ],
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

    /**
     * @todo alignment for icon + size
     */
    public function getIcon(string $faCode): string
    {
        include \PFAD_ROOT . \PFAD_TEMPLATES . 'NOVA/themes/base/fontawesome/metadata/icons.php';

        $faGlyphHex = $faTable[$faCode];
        $faClass    = \substr($faCode, 0, 3);

        return '<span class="opc-Icon opc-Icon-' . $faClass . '">&#x' . $faGlyphHex . ';</span>';
    }
}
