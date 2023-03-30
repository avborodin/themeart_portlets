<?php declare(strict_types=1);

namespace Plugin\themeart_portlets;

use JTL\License\Struct\ExsLicense;
use JTL\Plugin\Bootstrapper;
use JTL\Events\Dispatcher;
use JTL\IO\IO;
use JTL\Smarty\JTLSmarty;
use JTL\Shop;
use JTL\Helpers\Form;
use Plugin\themeart_portlets\Plugin\Whatsapp\Whatsapp;
use Plugin\themeart_portlets\Plugin\Product\Product;
use Plugin\themeart_portlets\Plugin\Instagram\InstagramHelper;

class Bootstrap extends Bootstrapper
{
	public function boot(Dispatcher $dispatcher): void
	{
		parent::boot($dispatcher);

		$plugin = $this->getPlugin();

		if(Shop::isAdmin()){
			if(isset($_GET['token']) && isset($_GET['ig_token']) && isset($_GET['ig_time_expire_token'])){
				if (Form::validateToken()) {
					$ig = new InstagramHelper($plugin);
					$ig->updateSetting('ig_token', $_GET['ig_token']);
					$ig->updateSetting('ig_time_expire_token', $_GET['ig_time_expire_token']);
					header("location: plugin.php?kPlugin=".$plugin->getID());
					exit();
				}
			}
		}

		if(Shop::isFrontend()) {
			try {
				$io = IO::getInstance();

				$io->register(
					"loadConfigurationImage",
					"loadConfigurationImage",
					$this->getPlugin()->getPaths()->getBasePath() . "includes" . \DIRECTORY_SEPARATOR . "io.php"
				);
				
				if(
					$plugin->getConfig()->getValue('isLightsearch') === 'Y' &&
					!$io->exists("lightsearch")
				) {
					$searchInc = PFAD_ROOT . 'plugins/themeart_portlets/Plugin/LightSearch/suggestions.php';
					$io->register('lightsearch', 'lightsearch', $searchInc, 'SETTINGS_SEARCH_VIEW');

					$dispatcher->listen("shop.hook." . \HOOK_IO_HANDLE_REQUEST, function($args) {
						$data = json_decode($_REQUEST['io']);
						if($data->name == 'suggestions') {
							$args["request"] = '{"name":"lightsearch", "params":["' . $data->params[0] . '"]}';
						}
					});
				}

				if($plugin->getConfig()->getValue('isWhatsappButton') == 'Y'){
					$dispatcher->listen("shop.hook." . \HOOK_SMARTY_OUTPUTFILTER, [new Whatsapp($plugin), "getButton"]);
				}
				
				if($plugin->getConfig()->getValue('isProductStock') == 'Y'){
					$dispatcher->listen("shop.hook." . \HOOK_SMARTY_OUTPUTFILTER, [new Product($plugin), "getStockInfo"]);
				}

				if( $plugin->getConfig()->getValue('loadInfiniteScroll') < 3){
					$dispatcher->listen("shop.hook." . \HOOK_SMARTY_OUTPUTFILTER, [new Product($plugin), "setInfiniteScroll"]);
				}

				$ig = new InstagramHelper($plugin);
				$timeExpireToken = $ig->getExpireToken();
				$ig_token = $ig->getToken();
				
				
				if(isset($ig_token) && $timeExpireToken > 0){
					$timeExpireToken = $timeExpireToken-(24*60*60);
					$timeNow = time();
					if($timeExpireToken < $timeNow){
						$res = $ig->refreshToken($ig_token);
						$ig->updateSetting('ig_token',$res->ig_token);
						$ig->updateSetting('ig_time_expire_token',$res->time_expire_token);
					}
				}

				if($plugin->getConfig()->getValue('isPaymentIcons') == 'Y'){
					$dispatcher->listen("shop.hook." . \HOOK_SMARTY_OUTPUTFILTER, [$this, "getPaymentIcons"]);
				}

			} catch(\Exception $exception) {
				Shop::Container()->getLogService()->error($exception->getMessage());
				exit;
			}
		}
	}

	private function tr($action)
	{
		$cNameA = explode("\\",__NAMESPACE__);
		$cName = end($cNameA);

		$tr = "https://analytics.themeart.de/matomo.php?";
		$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : null;
		$sa = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : null;
		$port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : null;
		$ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
		$lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : null;

		$data = array(
			"idsite" => "1",
			"rec" => "1",
			"dimension1" => $sa,
			"dimension2" => $host,
			"dimension3" => $port,
			"dimension4" => $action,
			"dimension5" => Shop::getApplicationVersion(),
			"dimension6" => "plg: " . $cName,
			"action_name" => $host . " " . $action . " Plugin " . $cName,
			"url" => Shop::getURL(),
			"lang" => $lang,
			"ua" => $ua
		);

		$success = false;

		if(extension_loaded("curl")) {
			$ch = curl_init($tr . http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_TIMEOUT, 7);
			$success = curl_exec($ch);
			curl_close($ch);
		}

		if(!$success) {
			file_get_contents($tr . http_build_query($data));
		}
	}

	/**
	 * @inheritDoc
	 */
	public function licenseExpired(ExsLicense $license): void
	{
		parent::licenseExpired($license);
		$this->tr("license expired");
	}

	/**
	 * @inheritdoc
	 */
	public function installed(): void
	{
		parent::installed();
		$this->tr("installed");
	}

	/**
	 * @inheritDoc
	 */
	public function enabled(): void
	{
		parent::enabled();
		$this->tr("enabled");
	}

	/**
	 * @inheritDoc
	 */
	public function disabled(): void
	{
		parent::enabled();
		$this->tr("disabled");
	}

	/**
	 * @inheritdoc
	 */
	public function updated($oldVersion, $newVersion): void
	{
		parent::updated($oldVersion, $newVersion);
		$this->tr("updated");
	}

	/**
	 * @inheritdoc
	 */
	public function uninstalled(bool $deleteData = true): void
	{
		parent::uninstalled($deleteData);
		$this->tr("uninstalled");
	}

	public function renderAdminMenuTab(string $tabName, int $menuID, JTLSmarty $smarty): string
	{
		if ($tabName !== 'Instagram') {
			return parent::renderAdminMenuTab($tabName, $menuID, $smarty);
		}
		
		$plugin = $this->getPlugin();
		$ig = new InstagramHelper($plugin);
		
		if (!empty($_POST) && Form::validateToken()) {
			if (isset($_POST['deleteTokenInstagram'])) {
				$ig->updateSetting('ig_token','0');
				$ig->updateSetting('ig_time_expire_token','0');
			}
		}
		return $ig->getForm();
	}

	public function getPaymentIcons()
	{
		/*if(\Shop()::getPageType()!==\PAGE_WARENKORB) {
			return null;
		}*/

		$plugin = $this->getPlugin();
		$selector = $plugin->getConfig()->getValue('selectorPaymentIcons');
		
		if(!empty($selector)) {
			$paymentIcons = Shop::Container()->getDB()->getObjects("SELECT cName, cBild FROM tzahlungsart WHERE cBild !='' AND nActive = 1 ORDER BY nSort");
			$html = Shop::Smarty()->assign('paymentIcons', $paymentIcons)
				->fetch($plugin->getPaths()->getFrontendPath() . 'template/payment_icons.tpl');

			\pq($selector)->after($html);
		}
	}
}