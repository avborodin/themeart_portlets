<?php declare(strict_types=1);

namespace Plugin\themeart_portlets;

use JTL\Widgets\AbstractWidget;

class ThemeartNewsWidget extends AbstractWidget
{
	/**
	 * @inheritDoc
	 */
	public function getContent()
	{
		return $this->oSmarty->fetch(__DIR__ . "/widget.tpl");
	}
}
