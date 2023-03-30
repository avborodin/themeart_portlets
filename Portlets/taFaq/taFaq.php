<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taFaq;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class taFaq
 */
class taFaq extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'groups' => [
                'type' => InputType::TEXT_LIST,
                'label' => __('groupName'),
                'default' => [__('groupName')]
            ],
            'expanded' => [
                'type' => InputType::CHECKBOX,
                'label' => __('unfoldFirstGroup'),
                'width' => 30,
            ],
            'schema' => [
                'type' => InputType::CHECKBOX,
                'label' => __('googleFaqSchema'),
                'width' => 30,
            ],
            'bold' => [
                'type' => InputType::CHECKBOX,
                'label' => __('textBold'),
                'width' => 30,
            ],
            'search' => [
                'type' => InputType::CHECKBOX,
                'label' => __('showSearch'),
                'width' => 30,
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