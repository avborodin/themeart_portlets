<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taGallery;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;

/**
 * Class taGallery
 */
class taGallery extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'galleryStyle' => [
                'type'    => InputType::GALLERY_LAYOUT,
                'label'   => 'Layout',
            ],
            'images' => [
                'type'        => InputType::IMAGE_SET,
                'label'       => __('imageList'),
                'default'     => [],
                'useLinks'    => true,
                'useLightbox' => true,
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
