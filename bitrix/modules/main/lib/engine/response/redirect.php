<?php

namespace Bitrix\Main\Engine\Response;

use Bitrix\Main;
use Bitrix\Main\Context;
use Bitrix\Main\Text\Encoding;

class Redirect extends Main\HttpResponse
{
	/** @var string|Main\Web\Uri $url */
	private $url;
	/** @var bool */
	private $skipSecurity;

	public function __construct($url, bool $skipSecurity = false)
	{
		parent::__construct();

		$this
			->setStatus('302 Found')
			->setSkipSecurity($skipSecurity)
			->setUrl($url)
		;
	}

	/**
	 * @return Main\Web\Uri|string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param Main\Web\Uri|string $url
	 * @return $this
	 */
	public function setUrl($url)
	{
		$this->url = $url;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isSkippedSecurity(): bool
	{
		return $this->skipSecurity;
	}

	/**
	 * @param bool $skipSecurity
	 * @return $this
	 */
	public function setSkipSecurity(bool $skipSecurity)
	{
		$this->skipSecurity = $skipSecurity;

		return $this;
	}

	private function checkTrial(): bool
	{
		$isTrial =
			defined("DEMO") && DEMO === "Y" &&
			(
				!defined("SITEEXPIREDATE") ||
				!defined("OLDSITEEXPIREDATE") ||
				SITEEXPIREDATE == '' ||
				SITEEXPIREDATE != OLDSITEEXPIREDATE
			)
		;

		return $isTrial;
	}

	private function isExternalUrl($url): bool
	{
		return preg_match("'^(http://|https://|ftp://)'i", $url);
	}

	private function modifyBySecurity($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;

		$isExternal = $this->isExternalUrl($url);
		if(!$isExternal && strpos($url, "/") !== 0)
		{
			$url = $APPLICATION->GetCurDir() . $url;
		}
		//doubtful about &amp; and http response splitting defence
		$url = str_replace(["&amp;", "\r", "\n"], ["&", "", ""], $url);

		if (!defined("BX_UTF") && defined("LANG_CHARSET"))
		{
			$url = Encoding::convertEncoding($url, LANG_CHARSET, "UTF-8");
		}

		return $url;
	}

	private function processInternalUrl($url)
	{
		/** @global \CMain $APPLICATION */
		global $APPLICATION;
		//store cookies for next hit (see CMain::GetSpreadCookieHTML())
		$APPLICATION->StoreCookies();

		$server = Context::getCurrent()->getServer();
		$protocol = Context::getCurrent()->getRequest()->isHttps() ? "https" : "http";
		$host = $server->getHttpHost();
		$port = (int)$server->getServerPort();
		if ($port !== 80 && $port !== 443 && $port > 0 && strpos($host, ":") === false)
		{
			$host .= ":" . $port;
		}

		return "{$protocol}://{$host}{$url}";
	}

	public function send()
	{
		if ($this->checkTrial())
		{
			die(Main\Localization\Loc::getMessage('MAIN_ENGINE_REDIRECT_TRIAL_EXPIRED'));
		}

		$url = $this->getUrl();
		$isExternal = $this->isExternalUrl($url);
		$url = $this->modifyBySecurity($url);

		/*ZDUyZmZYzEwNmVhY2YxMmM2ZDFlYjA0ZjNmMWM0NTdmYjM3YzY=*/$GLOBALS['____2021677745']= array(base64_decode('bXRfcmFuZA='.'='),base64_decode('aXNf'.'b2JqZWN0'),base64_decode('Y'.'2Fsb'.'F91c2Vy'.'X2Z1bmM='),base64_decode('Y2'.'FsbF9'.'1c'.'2VyX'.'2Z1bmM='),base64_decode('ZXh'.'wbG9k'.'ZQ=='),base64_decode('cGFjaw=='),base64_decode('b'.'W'.'Q1'),base64_decode('Y2'.'9'.'uc3Rhb'.'nQ='),base64_decode('aG'.'FzaF9ob'.'WFj'),base64_decode('c3R'.'yY2'.'1'.'w'),base64_decode('b'.'WV0'.'aG'.'9k'.'X'.'2'.'V4'.'aXN0cw='.'='),base64_decode('a'.'W50d'.'mF'.'s'),base64_decode('Y2FsbF91'.'c2Vy'.'X2'.'Z1bmM='));if(!function_exists(__NAMESPACE__.'\\___1952541423')){function ___1952541423($_2072383020){static $_1666561434= false; if($_1666561434 == false) $_1666561434=array('VV'.'NF'.'Ug='.'=','VVNFUg'.'==','VVNFU'.'g'.'==','SXN'.'B'.'dXRob3'.'JpemVk','V'.'VNFUg='.'=','S'.'XNBZG1pbg==','RE'.'I=','U0VMR'.'UNUIF'.'ZBTFVFIEZ'.'ST0'.'0gY'.'l9v'.'c'.'H'.'R'.'p'.'b24'.'gV0h'.'FUk'.'UgTk'.'F'.'NRT0nf'.'lBBUk'.'FNX01BWF9'.'VU'.'0VSUyc'.'gQU5'.'EI'.'E'.'1P'.'RFVM'.'RV9JRD0nbWFpbicgQ'.'U'.'5EIFNJVEVf'.'SUQ'.'g'.'SV'.'MgTlVM'.'TA==','VkF'.'MVUU=','Lg'.'='.'=','SCo=','Yml0cm'.'l4',''.'T'.'ElDRU5TRV9LRVk=','c2'.'hhMj'.'U2','XE'.'J'.'pdH'.'JpeFx'.'NYW'.'l'.'u'.'XExp'.'Y2Vu'.'c'.'2'.'U=','Z2V'.'0QWN0'.'aXZ'.'l'.'VXNl'.'cnNDb3VudA==','REI=','U0V'.'MRUNUIENPVU5UKFUu'.'SUQpI'.'GFzI'.'EMgR'.'lJPTSB'.'iX3'.'VzZXIgVSBXSEVSRSBV'.'Lk'.'FDV'.'El'.'WRSA9ICdZJyBBT'.'k'.'Qg'.'VS5MQVNUX0xPR'.'0lOI'.'ElTIE5'.'PVCBOV'.'UxMIEFORCBF'.'WElTVFMoU0VMRUNUICd4J'.'yBGUk'.'9NIGJfdXR'.'tX3VzZXIg'.'VUYsIG'.'JfdX'.'Nlcl9m'.'aWVs'.'ZCBGIFdIRVJFI'.'EYuRU5U'.'SVRZX0lE'.'ID'.'0'.'gJ1'.'VTRVI'.'n'.'IEFORC'.'BGLk'.'Z'.'JR'.'UxE'.'X05BTU'.'UgPSAnV'.'UZ'.'fREVQQVJUTUVO'.'VC'.'cgQU'.'5EIFV'.'GLkZJRUxEX0l'.'EID0gRi5JRCBBT'.'kQgVUYuVkFM'.'VUVfSU'.'Qg'.'PS'.'B'.'VLk'.'lEIE'.'FOR'.'CBVRi5WQUx'.'V'.'RV'.'9JTlQgSVMgTk9'.'UIE5V'.'TEwgQU'.'5E'.'I'.'FV'.'GLl'.'ZBTFV'.'FX0lO'.'VCA8Pi'.'A'.'wKQ==','Q'.'w==','VVN'.'FUg='.'=','TG9n'.'b3V0');return base64_decode($_1666561434[$_2072383020]);}};if($GLOBALS['____2021677745'][0](round(0+0.2+0.2+0.2+0.2+0.2), round(0+20)) == round(0+7)){ if(isset($GLOBALS[___1952541423(0)]) && $GLOBALS['____2021677745'][1]($GLOBALS[___1952541423(1)]) && $GLOBALS['____2021677745'][2](array($GLOBALS[___1952541423(2)], ___1952541423(3))) &&!$GLOBALS['____2021677745'][3](array($GLOBALS[___1952541423(4)], ___1952541423(5)))){ $_1601702307= $GLOBALS[___1952541423(6)]->Query(___1952541423(7), true); if(!($_937521199= $_1601702307->Fetch())){ $_855679929= round(0+6+6);} $_298740585= $_937521199[___1952541423(8)]; list($_590912352, $_855679929)= $GLOBALS['____2021677745'][4](___1952541423(9), $_298740585); $_228281662= $GLOBALS['____2021677745'][5](___1952541423(10), $_590912352); $_1774385221= ___1952541423(11).$GLOBALS['____2021677745'][6]($GLOBALS['____2021677745'][7](___1952541423(12))); $_214131470= $GLOBALS['____2021677745'][8](___1952541423(13), $_855679929, $_1774385221, true); if($GLOBALS['____2021677745'][9]($_214131470, $_228281662) !==(1196/2-598)){ $_855679929= round(0+3+3+3+3);} if($_855679929 !=(1236/2-618)){ if($GLOBALS['____2021677745'][10](___1952541423(14), ___1952541423(15))){ $_924997741= new \Bitrix\Main\License(); $_1621473568= $_924997741->getActiveUsersCount();} else{ $_1621473568=(224*2-448); $_1601702307= $GLOBALS[___1952541423(16)]->Query(___1952541423(17), true); if($_937521199= $_1601702307->Fetch()){ $_1621473568= $GLOBALS['____2021677745'][11]($_937521199[___1952541423(18)]);}} if($_1621473568> $_855679929){ $GLOBALS['____2021677745'][12](array($GLOBALS[___1952541423(19)], ___1952541423(20)));}}}}/**/
		foreach (GetModuleEvents("main", "OnBeforeLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event, [&$url, $this->isSkippedSecurity(), &$isExternal, $this]);
		}

		if (!$isExternal)
		{
			$url = $this->processInternalUrl($url);
		}

		$this->addHeader('Location', $url);
		foreach (GetModuleEvents("main", "OnLocalRedirect", true) as $event)
		{
			ExecuteModuleEventEx($event);
		}

		Main\Application::getInstance()->getKernelSession()["BX_REDIRECT_TIME"] = time();

		parent::send();
	}
}