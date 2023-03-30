<?php declare(strict_types=1);

namespace Plugin\themeart_portlets\Plugin;

use SimpleXMLElement;

class Feed
{
	private $xml;
	private $rssFeed = [];

	public function __construct($url)
	{
		$this->loadXml($url);

		if($this->xml instanceof SimpleXMLElement) {
			$this->rssFeed = $this->toArray($this->xml);
		}
	}

	/**
	 * Load XML from cache or HTTP.
	 * @param $url string
	 */
	public function loadXml($url)
	{
		$data = $this->httpRequest(trim($url));

		if($data) {
			$this->xml = new SimpleXMLElement($data, LIBXML_NOWARNING | LIBXML_NOERROR);
		}
	}

	/**
	 * Converts a SimpleXMLElement into an array.
	 * @param $xml SimpleXMLElement
	 * @return array
	 */
	public function toArray(SimpleXMLElement $xml = null)
	{
		if($xml === null) {
			$xml = $this->xml;
		}

		if(!$xml->children()) {
			return (string) $xml;
		}

		$arr = [];

		foreach($xml->children() as $tag => $child) {
			if(\count($xml->$tag)===1 && $tag!=="item") {
				$arr[$tag] = $this->toArray($child);
			} else if(\count($xml->$tag)===1 && $tag==="item") {
				$item = [];
				foreach($child->children() as $childTag => $childValue) {
					$item[$tag][$childTag] = $this->toArray($childValue);
				}

				$arr[$tag] = $item;
			} else {
				$arr[$tag][] = $this->toArray($child);
			}
		}

		return $arr;
	}

	/**
	 * Process HTTP request.
	 * @param $url string
	 * @return string|false
	 */
	private function httpRequest($url)
	{
		if(extension_loaded("curl")) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_USERAGENT, "JTL Shop");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_TIMEOUT, 10);
			curl_setopt($curl, CURLOPT_ENCODING, "");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			if (!ini_get("open_basedir")) {
				curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			}

			$result = curl_exec($curl);

			return curl_errno($curl) === 0 && curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200 ? $result : false;
		}

		return false;
	}

	/**
	 * @return array
	 */
	public function getRssFeed()
	{
		return $this->rssFeed;
	}
}