<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taProduct;

use JTL\Catalog\Product\Artikel;
use JTL\Customer\CustomerGroup;
use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
 * Class ProductFeed
 */
class taProduct extends Portlet
{
	private function getTemplatePath()
	{
		return $this->getBasePath() . "template/";
	}

	public function getPreviewHtml(PortletInstance $instance): string
	{
		return "Product";
	}

	public function getFinalHtml(PortletInstance $instance, bool $inContainer = true): string
	{
		$articleNr 	= $instance->getProperty("articleNr");
		$template 	= $instance->getProperty("template");
		$imageSize 	= $instance->getProperty("imageSize");
		$shortdescription = $instance->getProperty("shortdescription");
		$articleFkt	= $instance->getProperty("articleFkt");
		$tplPath 	= $this->getTemplatePath();

		$article = \Shop()::Container()->getDB()->executeQueryPrepared("SELECT * FROM tartikel WHERE cArtNr = :id",['id' => $articleNr], 1);

		if($article instanceof \stdClass) {
			$product = $this->getProduct($article->kArtikel);
			// load short description from funktionsattribut
			if (strlen($articleFkt) > 0 && isset ($product->FunktionsAttribute[$articleFkt])) {
				$product->cKurzBeschreibung = $product->FunktionsAttribute[$articleFkt];
			}
			\Shop()::Smarty()->assign("shortdescription", $shortdescription);
			\Shop()::Smarty()->assign("imageSize", $imageSize);
			\Shop()::Smarty()->assign("Artikel", $product);
			\Shop()::Smarty()->assign("instance", $instance);
			\Shop()::Smarty()->assign("images", $product->getImages());
			
			return \Shop()::Smarty()->fetch($tplPath . $template . ".tpl");
		}

		return '';
	}

	private function getProduct($id)
	{
		$customerGroup = null;

		if(isset($_SESSION["Kundengruppe"])) {
			$customerGroup = $_SESSION["Kundengruppe"];
		}

		if(!$customerGroup instanceof CustomerGroup) {
			$customerGroup = new CustomerGroup();
		}

		return (new Artikel())->fuelleArtikel(
			(int) $id,
			Artikel::getDefaultOptions(),
			(int) $customerGroup->getID()
		);
	}

	/**
	 * @return array
	 */
	public function getPropertyDesc(): array
	{
		return [
			'articleNr' => [
				'type' => InputType::TEXT,
				'label' => __('ArtNr'),
				'placeholder' => '',
				'width' => 30,
				'order' => 1
			],
			'template' => [
				'type' => InputType::SELECT,
				'label' => __('template'),
				'options' => $this->getTemplates(),
				'width' => 30,
				'order' => 2
			],
			'imageSize' => [
				'type' => InputType::SELECT,
				'label' => __('imageSize'),
				'options' => [
					"cURLMini" => "Mini",
					"cURLKlein" => "Klein",
					"cURLNormal" => "Normal",
					"cURLGross" => "Gross"
				],
				'width' => 30,
				'order' => 3
			],
			'articleFkt' => [
				'type' => InputType::TEXT,
				'label' => __('fkt'),
				'placeholder' => 'shopdescription',
				'width' => 30,
				'order' => 4,
				'desc' => __('fktDesc'),
			],
			'shortdescription' => [
                'type' => InputType::CHECKBOX,
                'label' => __('shortDescription'),
                'width' => 30,
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
			__('Animation') => 'animations'
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