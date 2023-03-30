<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Migrations;

use JTL\Plugin\Migration;
use JTL\Update\IMigration;
use JTL\Plugin\Helper;
use JTL\Plugin\Plugin;
use Plugin\themeart_portlets\Plugin\PortletFixHelper;

class Migration20200523090000 extends Migration implements IMigration
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
