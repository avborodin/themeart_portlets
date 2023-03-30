<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taEasySlider;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;

/**
* Class taEasySlider
*/
class taEasySlider extends Portlet
{

	public function getPropertyDesc(): array
	{
		return [
			'slider-mode' => [
				'label'   => __('slideMode'),
				'type'    => InputType::SELECT,
				'options' => [
					'carousel' => 'carousel',
					'gallery'  => 'gallery',
				],
				'default' => 'carousel',
				'width'   => 25,
			],
			'slider-items' => [
				'label'   => __('sliderItems'),
				'type'    => InputType::NUMBER,
				'default' => 1,
				'width'   => 25,
			],
			'slider-gutter' => [
				'label'    => __('sliderGutter'),
				'type'     => InputType::NUMBER,
				'default'  => 0,
				'width'    => 25,
			],
			'slider-edgePadding' => [
				'label'	  => __('sliderEdgePadding'),
				'type'    => InputType::NUMBER,
				'default' => 0,
				'width'   => 25,
			],
			'slider-fixedWidth' => [
				'label'   => __('sliderFixedWidth'),
				'type'    => InputType::NUMBER,
				'default' => 'false',
				'width'   => 25,
			],
			'slider-autoWidth' => [
				'label'   => __('slideAutoWidth'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'	  => 25,
			],
			'slider-viewportMax' => [
				'label'   => __('sliderViewportMax'),
				'type'    => InputType::NUMBER,
				'default' => 'false',
				'width'   => 25,
			],
			'slider-slideBy' => [
				'label'   => __('sliderBy'),
				'type'    => InputType::NUMBER,
				'default' => 1,
				'width'   => 25,
			],
			'slider-center' => [
				'label'   => __('slideCenter'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'	  => 25,
			],
			'slider-controls' => [
				'label'   => __('slideControls'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'	  => 25,	
			],
			'slider-controlsPosition' => [
				'label'   => __('slideСontrolsPosition'),
				'type'    => InputType::SELECT,
				'options' => [
					'top'    => 'top',
					'buttom' => 'buttom',
				],
				'default' => 'buttom',
				'width'   => 25,
			],
			'slider-nav' => [
				'label'   => __('sliderNav'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-navPosition' => [
				'label'   => __('slideNavPosition'),
				'type'    => InputType::SELECT,
				'options' => [
					'top'    => 'top',
					'buttom' => 'buttom',
				],
				'default' => 'buttom',
				'width'   => 25,
			],
			'slider-navAsThumbnails' => [
				'label'   => __('sliderNavAsThumbnails'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-arrowKeys' => [
				'label'   => __('sliderArrowKeys'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-speed' => [
				'label'   => __('sliderSpeed'),
				'type'    => InputType::NUMBER,
				'default' => 300,
				'width'   => 25,
			],		
			'slider-autoplay' => [
				'label'   => __('slideAutoplay'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'	  => 25,
			],
			'slider-autoplayPosition' => [
				'label'   => __('slideAutoplayPosition'),
				'type'    => InputType::SELECT,
				'options' => [
					'top'    => 'top',
					'buttom' => 'buttom',
				],
				'default' => 'top',
				'width'   => 25,
			],
			'slider-autoplayTimeout' => [
				'label'   => __('sliderAutoplayTimeout'),
				'type'    => InputType::NUMBER,
				'default' => 5000,
				'width'   => 25,	
			],
			'slider-autoplayDirection' => [
				'label'   => __('slideAutoplayDirection'),
				'type'    => InputType::SELECT,
				'options' => [
					'forward'    => 'forward',
					'backward' => 'backward',
				],
				'default' => 'forward',
				'width'   => 25,
			],
			'slider-autoplayHoverPause' => [
				'label'   => __('sliderAutoplayHoverPause'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('pauseOnHoverPause'),
					'false' => __('pauseOnHoverContinue'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-autoplayButtonOutput' => [
				'label'   => __('slideAutoplayButtonOutput'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'	  => 25,
			],
			'slider-autoplayResetOnVisibility' => [
				'label'   => __('slideAutoplayResetOnVisibility'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'	  => 25,
			],
			'slider-animateIn' => [
				'label'   => __('sliderAnimateIn'),
				'type'    => InputType::TEXT,
				'default' => 'tns-fadeIn',
				'width'   => 25,	
			],
			'slider-animateOut' => [
				'label'   => __('sliderAnimateOut'),
				'type'    => InputType::TEXT,
				'default' => 'tns-fadeOut',
				'width'   => 25,	
			],
			'slider-animateNormal' => [
				'label'   => __('sliderAnimateNormal'),
				'type'    => InputType::TEXT,
				'default' => 'tns-normal',
				'width'   => 25,	
			],
			'slider-animateDelay' => [
				'label'   => __('sliderAnimateDelay'),
				'type'    => InputType::NUMBER,
				'default' => 'false',
				'width'   => 25,
			],
			'slider-loop' => [
				'label'   => __('sliderLoop'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'   => 25,
			],
			'slider-rewind' => [
				'label'   => __('sliderRewind'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-autoHeight' => [
				'label'   => __('sliderRewind'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'   => 25,
			],
			'slider-touch' => [
				'label'   => __('sliderTouch'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'   => 25,
			],
			'slider-mouseDrag' => [
				'label'   => __('sliderMouseDrag'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-swipeAngle' => [
				'label'   => __('sliderSwipeAngle'),
				'type'    => InputType::NUMBER,
				'default' => 0,
				'width'   => 25,	
			],
			'slider-preventActionWhenRunning' => [
				'label'   => __('sliderPreventActionWhenRunning'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-preventScrollOnTouch' => [
				'label'   => __('slidePreventScrollOnTouch'),
				'type'    => InputType::SELECT,
				'options' => [
					'auto'    => 'auto',
					'force' => 'force',
					'false' => 'false',
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-nested' => [
				'label'   => __('slideNested'),
				'type'    => InputType::SELECT,
				'options' => [
					'inner'    => 'inner',
					'outer' => 'outer',
					'false' => 'false',
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-freezable' => [
				'label'   => __('sliderFreezable'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'   => 25,
			],
			'slider-disable' => [
				'label'   => __('sliderDisable'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'false',
				'width'   => 25,
			],
			'slider-startIndex' => [
				'label'   => __('sliderStartIndex'),
				'type'    => InputType::NUMBER,
				'default' => 0,
				'width'   => 25,	
			],
			'slider-useLocalStorage' => [
				'label'   => __('sliderUseLocalStorage'),
				'type'    => InputType::RADIO,
				'options' => [
					'true'  => __('yes'),
					'false' => __('no'),
				],
				'default' => 'true',
				'width'   => 25,
			],
			//controlsText
			//controlsContainer
			//prevButton
			//nextButton
			//navContainer
			//navAsThumbnails
			//autoplayText
			//autoplayButton
			//responsive
			//lazyload
			//lazyloadSelector
			//onInit
			//nonce
			'slides' => [
				'label'     => __('images'),
				'type'      => InputType::IMAGE_SET,
				'default'   => [],
				'useLinks'  => true,
				'useTitles' => true,
			],
		];
	}

	/**
	* @return array
	*/
	public function getPropertyTabs(): array
	{
		return [
			__('Slides') => ['slides'],
			__('Animation') => 'animations'
		];
	}
}