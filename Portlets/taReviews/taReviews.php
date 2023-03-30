<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taReviews;

use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;
use JTL\OPC\InputType;
use JTL\Shop;

class taReviews extends Portlet
{
    private function getTemplatePath()
    {
        return $this->getBasePath() . "template/";
    }

    public function getFinalHtml(PortletInstance $instance, bool $inContainer = true): string
    {
        $smarty         = Shop::Smarty();

        $reviewStars    = $instance->getProperty("reviewStars");
        $reviewSortStar = $instance->getProperty("reviewSortStar");
        $reviewSortDate = $instance->getProperty("reviewSortDate");
        $reviewNum      = $instance->getProperty("reviewNum");
        
        $template 	    = $instance->getProperty("template");
        $tplPath 	    = $this->getTemplatePath();

        $languageID     = Shop::getLanguageID();

        if(!empty($reviewStars)){
            $reviewStars = " AND nSterne = ".(int)$reviewStars;
        }else{
            $reviewStars = '';
        }

        if(empty($reviewNum)) {
            $reviewNum = 10;
        }

        $sql = "SELECT * FROM 
                    tbewertung 
                WHERE 
                    kSprache = ".$languageID." 
                AND 
                    nAktiv = 1 
                    ".$reviewStars." 
                ORDER BY 
                    rand(), 
                    nSterne ".$reviewSortStar.", 
                    dDatum ".$reviewSortDate."  
                LIMIT 
                    ".(int)$reviewNum;

        $reviews = Shop::Container()->getDB()->getObjects($sql);

        $smarty->assign('reviews', $reviews);

        return $smarty->fetch($tplPath . $template . ".tpl");
    }
    
    public function getPropertyDesc(): array
    {
        return [
            'template' => [
				'type' => InputType::SELECT,
				'label' => __('template'),
				'options' => $this->getTemplates(),
				'width' => 30,
				'order' => 1
			],
            'reviewStars' => [
                'type' => InputType::SELECT,
                'label' => __('Number of stars'),
                'options' => [
                    "" => __('Select'),
                    "1" => __('One star'),
                    "2" => __('Two stars'),
                    "3" => __('Three stars'),
                    "4" => __('Four stars'),
                    "5" => __('Five stars'),
                ],
                'placeholder' => '',
                'width' => 30,
                'order' => 2
            ],
            'reviewSortStar' => [
                'type' => InputType::SELECT,
                'label' => __('Sort by stars'),
                'options' => [
                    "ASC" => __('ASC'),
                    "DESC" => __('DESC'),
                ],
                'placeholder' => '',
                'width' => 30,
                'order' => 3
            ],
            'reviewSortDate' => [
                'type' => InputType::SELECT,
                'label' => __('Sort by date'),
                'options' => [
                    "ASC" => __('ASC'),
                    "DESC" => __('DESC'),
                ],
                'placeholder' => '',
                'width' => 30,
                'order' => 4
            ],
            'reviewNum' => [
                'type' => InputType::TEXT,
                'label' => __('Number of reviews'),
                'placeholder' => '10',
                'width' => 30,
                'order' => 5
            ]
        ];
    }

    public function getPropertyTabs(): array
    {
        return [
            __('Styles')    => 'styles',
            __('Animation') => 'animations',
        ];
    }

    private function getTemplates()
	{
		$tplPath = $this->getTemplatePath();

		$templates = [];

		if(file_exists($tplPath)) {
			$files = array_diff(scandir($tplPath), array('..', '.'));
			array_walk(
				$files,
				function($v) use (&$templates) {
					$k = str_replace(".tpl", "", $v);
					$templates[$k] = ucfirst(str_replace("_", " ", $k));
				}
			);
		}

		return $templates;
	}
}