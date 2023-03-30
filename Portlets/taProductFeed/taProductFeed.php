<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taProductFeed;

use Illuminate\Support\Collection;
use JTL\Catalog\Product\Artikel;
use JTL\Exceptions\CircularReferenceException;
use JTL\Exceptions\ServiceNotFoundException;
use JTL\Filter\AbstractFilter;
use JTL\Filter\Config;
use JTL\Filter\ProductFilter;
use JTL\Filter\Type;
use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;
use JTL\Shop;
use stdClass;

/**
 * Class ProductFeed
 */
class taProductFeed extends Portlet
{
    /**
     * @return array
     */
    public function getPropertyDesc(): array
    {
        return [
            'listStyle'    => [
                'type'    => InputType::SELECT,
                'label'   => __('presentation'),
                'width'   => 30,
                'order'   => 2,
                'options' => [
                    'gallery'      => __('presentationGallery'),
                    'list'         => __('presentationList'),
                    'simpleSlider' => __('presentationSimpleSlider'),
                    'slider'       => __('presentationSlider'),
                    'box-slider'   => __('presentationBoxSlider'),
                ],
                'default' => 'gallery',
            ],
            'search' => [
                'type'  => InputType::SEARCH,
                'label' =>  __('search'),
                'placeholder' => __('search'),
                'width' => 30,
                'order' => 1
            ],
            'maxResults' => [
                'type' => InputType::NUMBER,
                'label' => 'max. Anzahl',
                'placeholder' => 4,
                'width' => 15,
                'order' => 3
            ],
            'itemClass' => [
                'type'       => InputType::TEXT,
                'label' => __('class'),
                'placeholder' => '',
                'width' => 20,
                'order' => 4
            ],
            'filters'      => [
                'type'     => InputType::FILTER,
                'label'    => __('itemFilter'),
                'default'  => [],
                'searcher' => 'search',
                'order' => 5
            ]
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

    /**
     * @param PortletInstance $instance
     * @return Collection
     */
    public function getFilteredProductIds(PortletInstance $instance): Collection
    {
        $maxResults = (int) $instance->getProperty('maxResults');
        $enabledFilters = $instance->getProperty('filters');
        $productFilter  = new ProductFilter(
            Config::getDefault(),
            Shop::Container()->getDB(),
            Shop::Container()->getCache()
        );

        foreach ($enabledFilters as $enabledFilter) {
            /** @var AbstractFilter $newFilter * */
            $newFilter = new $enabledFilter['class']($productFilter);
            $newFilter->setType(Type::AND);

            $productFilter->addActiveFilter($newFilter, $enabledFilter['value']);
        }

        if($maxResults) {
            return $productFilter->getProductKeys()->slice(0, $maxResults);
        } else {
            return $productFilter->getProductKeys();
        }
    }

    /**
     * @param PortletInstance $instance
     * @return array
     * @throws CircularReferenceException
     * @throws ServiceNotFoundException
     */
    public function getFilteredProducts(PortletInstance $instance): array
    {
        $products                           = [];
        
        $defaultOptions                    = new stdClass();
        $defaultOptions->nMerkmale         = 0;
        $defaultOptions->nKategorie        = 0;
        $defaultOptions->nAttribute        = 0;
        $defaultOptions->nArtikelAttribute = 0;
        $defaultOptions->nMedienDatei      = 0;
        $defaultOptions->nDownload         = 0;
        $defaultOptions->nKonfig           = 1;
        $defaultOptions->nVariationen      = 1;
        $defaultOptions->nRatings          = 1;

        foreach ($this->getFilteredProductIds($instance) as $productID) {
            $products[] = (new Artikel())->fuelleArtikel($productID, $defaultOptions);
        }

        return $products;
    }
}
