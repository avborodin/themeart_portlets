<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Migrations;

use Plugin\themeart_portlets\Plugin\PortletFixHelper;
use JTL\Update\IMigration;
use JTL\Plugin\Migration;
use JTL\Plugin\Helper;
use JTL\Plugin\Plugin;

class Migration20220209175800 extends Migration implements IMigration
{
	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$plugin = Helper::getPluginById("themeart_portlets");

		if($plugin instanceof Plugin) {
			$portletFixHelper = new PortletFixHelper($plugin);
			$portletFixHelper->fixDates();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{

	}
}
