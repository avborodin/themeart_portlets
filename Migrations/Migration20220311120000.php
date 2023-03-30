<?php declare(strict_types=1);
namespace Plugin\themeart_portlets\Migrations;

use JTL\Plugin\Migration;
use JTL\Update\IMigration;

class Migration20220311120000 extends Migration implements IMigration
{

	public function up()
	{
		$this->execute(
			'CREATE TABLE IF NOT EXISTS `xplugin_themeart_portlet_settings` (
				`key` VARCHAR(255) NOT NULL,
				`value`  VARCHAR(255),
				UNIQUE (`key`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;'
		);

		$this->execute(
			'INSERT INTO `xplugin_themeart_portlet_settings` (`key`,`value`) 
			values
			("ig_token","0"),
			("ig_time_expire_token","0");'
		);

	}

	public function down()
	{
		$this->execute('DROP TABLE IF EXISTS `xplugin_themeart_portlet_settings`');
	}
}