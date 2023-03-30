<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Migrations;

use JTL\Plugin\Migration;
use JTL\Update\IMigration;
use Plugin\themeart_portlets\Plugin\PortletFixHelper;
use JTL\Plugin\Helper;
use JTL\Plugin\Plugin;

class Migration20200507090000 extends Migration implements IMigration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$plugin = Helper::getPluginById("themeart_portlets");

		if($plugin instanceof Plugin) {
			$portletFixHelper = new PortletFixHelper($plugin);
			$portletFixHelper->fix();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{

	}
}
