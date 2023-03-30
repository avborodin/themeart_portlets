<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Portlets\taPinterestFeed;

use JTL\OPC\InputType;
use JTL\OPC\Portlet;
use JTL\OPC\PortletInstance;
use JTL\helpers\Request;
/**
* Class taPinterestFeed
*/
class taPinterestFeed extends Portlet
{

	public function getPropertyDesc(): array
	{
		return [
			'selectWidget' => [
				'type'    => InputType::SELECT,
				'label'   => __('Select widget'),
				'width'   => 30,
				'options' => [
					'profi'  => __('Profile'),
					'board'  => __('Board'),
					'pin'    => __('Pin')
				],
				'default' => 'profi',
				'childrenFor' => [
					'profi' => [
						'profiName'  => [
							'label' => __('profiName'),
							'type'  => InputType::TEXT,
							'width' => 30,	
						],
						'profiWidth' => [
							'type'    => InputType::TEXT,
							'label'   => __('boardWidth'),
							'default' => '1200',
							'width'   => 30,
						],
						'profiHeight' => [
							'type'    => InputType::TEXT,
							'label'   => __('boardHeight'),
							'default' => '520',
							'width'   => 30,
						],
					],
					'board' => [
						'bprofiName'  => [
							'label' => __('profiName'),
							'type'  => InputType::TEXT,
							'width' => 30,
						],
						'boardName'  => [
							'label' => __('boardName'),
							'type'  => InputType::TEXT,
							'width' => 30,
						],
						'boardWidth' => [
							'type'    => InputType::TEXT,
							'label'   => __('boardWidth'),
							'default' => '1200',
							'width'   => 30,
						],
						'boardHeight' => [
							'type'    => InputType::TEXT,
							'label'   => __('boardHeight'),
							'default' => '520',
							'width'   => 30,			
						],
					],
					'pin' => [
						'pinNumber'  => [
							'label' => __('pinNumber'),
							'type'  => InputType::TEXT,
							'width' => 30,
						],
						'pinSize' => [
							'type'    => InputType::SELECT,
							'label'   => __('selectSize'),
							'width'   => 30,
							'options' => [
								'' 		 => __('small'),
								'medium' => __('medium'),
								'large'  => __('large')
							],
							'default' => 'medium',
						],
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
			__('Styles') => 'styles',
			__('Animation') => 'animations'
		];
	}
}