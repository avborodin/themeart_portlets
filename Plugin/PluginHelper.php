<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin;

use JTL\Plugin\PluginInterface;
use JTL\DB\DbInterface;
use JTL\Shop;

class PluginHelper
{
	private $plugin;
	private $db;
	private $settings;
	private $session;
	private $articleHelper;
	private $mobileDetect;

	public function __construct(PluginInterface $plugin, DbInterface $db)
	{
		$this->plugin = $plugin;
		$this->db = $db;
		$this->settings = new Settings($this);
		$this->session = new Session($this);
		$this->articleHelper = new ArticleHelper();
		$this->mobileDetect = new \Mobile_Detect();
	}

	public function isMobile()
	{
		return $this->mobileDetect->isMobile();
	}

	public function getAdminUrl()
	{
		return Shop::getURL() . "/" . "admin/plugin.php?kPlugin=" . $this->plugin->getID();
	}

	public function getToken()
	{
		return isset($_SESSION["jtl_token"]) ? $_SESSION["jtl_token"] : null;
	}

	public function isSecure()
	{
		return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443;
	}

	public function getShopUrl()
	{
		if($this->isSecure()) {
			return Shop::getURL(true);
		}

		return Shop::getURL(false);
	}

	public function getTemplateVar($var)
	{
		return Shop::Smarty()->getTemplateVars($var);
	}

	public function phpQuery($selector)
	{
		return \pq($selector);
	}

	public function phpQueryAdd($selector, $selectorMethod, $element)
	{
		switch($selectorMethod) {
			case "before":
				$this->phpQuery($selector)->before($element);
				break;
			case "after":
				$this->phpQuery($selector)->after($element);
				break;
			case "prepend":
				$this->phpQuery($selector)->prepend($element);
				break;
			case "append":
				$this->phpQuery($selector)->append($element);
				break;
		}
	}

	public function getPlugin(): PluginInterface
	{
		return $this->plugin;
	}

	public function getDb(): DbInterface
	{
		return $this->db;
	}

	public function getSettings(): Settings
	{
		return $this->settings;
	}

	public function getSession(): Session
	{
		return $this->session;
	}

	public function getArticleHelper(): ArticleHelper
	{
		return $this->articleHelper;
	}
}