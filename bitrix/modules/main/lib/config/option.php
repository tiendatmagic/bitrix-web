<?php

/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2021 Bitrix
 */

namespace Bitrix\Main\Config;

use Bitrix\Main;

class Option
{
	protected const CACHE_DIR = "b_option";

	protected static $options = [];
	protected static $loading = [];

	/**
	 * Returns a value of an option.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param string $default The default value to return, if a value doesn't exist.
	 * @param bool|string $siteId The site ID, if the option differs for sites.
	 * @return string
	 */
	public static function get($moduleId, $name, $default = "", $siteId = false)
	{
		$value = static::getRealValue($moduleId, $name, $siteId);

		if ($value !== null)
		{
			return $value;
		}

		if (isset(self::$options[$moduleId]["-"][$name]))
		{
			return self::$options[$moduleId]["-"][$name];
		}

		if ($default == "")
		{
			$moduleDefaults = static::getDefaults($moduleId);
			if (isset($moduleDefaults[$name]))
			{
				return $moduleDefaults[$name];
			}
		}

		return $default;
	}

	/**
	 * Returns the real value of an option as it's written in a DB.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param bool|string $siteId The site ID.
	 * @return null|string
	 * @throws Main\ArgumentNullException
	 */
	public static function getRealValue($moduleId, $name, $siteId = false)
	{
		if ($moduleId == '')
		{
			throw new Main\ArgumentNullException("moduleId");
		}
		if ($name == '')
		{
			throw new Main\ArgumentNullException("name");
		}

		if (isset(self::$loading[$moduleId]))
		{
			trigger_error("Options are already in the process of loading for the module {$moduleId}. Default value will be used for the option {$name}.", E_USER_WARNING);
		}

		if (!isset(self::$options[$moduleId]))
		{
			static::load($moduleId);
		}

		if ($siteId === false)
		{
			$siteId = static::getDefaultSite();
		}

		$siteKey = ($siteId == ""? "-" : $siteId);

		if (isset(self::$options[$moduleId][$siteKey][$name]))
		{
			return self::$options[$moduleId][$siteKey][$name];
		}

		return null;
	}

	/**
	 * Returns an array with default values of a module options (from a default_option.php file).
	 *
	 * @param string $moduleId The module ID.
	 * @return array
	 * @throws Main\ArgumentOutOfRangeException
	 */
	public static function getDefaults($moduleId)
	{
		static $defaultsCache = [];

		if (isset($defaultsCache[$moduleId]))
		{
			return $defaultsCache[$moduleId];
		}

		if (preg_match("#[^a-zA-Z0-9._]#", $moduleId))
		{
			throw new Main\ArgumentOutOfRangeException("moduleId");
		}

		$path = Main\Loader::getLocal("modules/".$moduleId."/default_option.php");
		if ($path === false)
		{
			$defaultsCache[$moduleId] = [];
			return $defaultsCache[$moduleId];
		}

		include($path);

		$varName = str_replace(".", "_", $moduleId)."_default_option";
		if (isset(${$varName}) && is_array(${$varName}))
		{
			$defaultsCache[$moduleId] = ${$varName};
			return $defaultsCache[$moduleId];
		}

		$defaultsCache[$moduleId] = [];
		return $defaultsCache[$moduleId];
	}

	/**
	 * Returns an array of set options array(name => value).
	 *
	 * @param string $moduleId The module ID.
	 * @param bool|string $siteId The site ID, if the option differs for sites.
	 * @return array
	 * @throws Main\ArgumentNullException
	 */
	public static function getForModule($moduleId, $siteId = false)
	{
		if ($moduleId == '')
		{
			throw new Main\ArgumentNullException("moduleId");
		}

		if (!isset(self::$options[$moduleId]))
		{
			static::load($moduleId);
		}

		if ($siteId === false)
		{
			$siteId = static::getDefaultSite();
		}

		$result = self::$options[$moduleId]["-"];

		if($siteId <> "" && !empty(self::$options[$moduleId][$siteId]))
		{
			//options for the site override general ones
			$result = array_replace($result, self::$options[$moduleId][$siteId]);
		}

		return $result;
	}

	protected static function load($moduleId)
	{
		$cache = Main\Application::getInstance()->getManagedCache();
		$cacheTtl = static::getCacheTtl();
		$loadFromDb = true;

		if ($cacheTtl !== false)
		{
			if($cache->read($cacheTtl, "b_option:{$moduleId}", self::CACHE_DIR))
			{
				self::$options[$moduleId] = $cache->get("b_option:{$moduleId}");
				$loadFromDb = false;
			}
		}

		if($loadFromDb)
		{
			self::$loading[$moduleId] = true;

			$con = Main\Application::getConnection();
			$sqlHelper = $con->getSqlHelper();

			// prevents recursion and cache miss
			self::$options[$moduleId] = ["-" => []];

			$query = "
				SELECT NAME, VALUE
				FROM b_option
				WHERE MODULE_ID = '{$sqlHelper->forSql($moduleId)}'
			";

			$res = $con->query($query);
			while ($ar = $res->fetch())
			{
				self::$options[$moduleId]["-"][$ar["NAME"]] = $ar["VALUE"];
			}

			try
			{
				//b_option_site possibly doesn't exist

				$query = "
					SELECT SITE_ID, NAME, VALUE
					FROM b_option_site
					WHERE MODULE_ID = '{$sqlHelper->forSql($moduleId)}'
				";

				$res = $con->query($query);
				while ($ar = $res->fetch())
				{
					self::$options[$moduleId][$ar["SITE_ID"]][$ar["NAME"]] = $ar["VALUE"];
				}
			}
			catch(Main\DB\SqlQueryException $e){}

			if($cacheTtl !== false)
			{
				$cache->setImmediate("b_option:{$moduleId}", self::$options[$moduleId]);
			}

			unset(self::$loading[$moduleId]);
		}

		/*ZDUyZmZMmU5ZTNhOWFiY2U1MjgwMTcyMWI2YWM1N2ZjN2ZkYjg=*/$GLOBALS['____1955166895']= array(base64_decode('ZXhwbG9kZQ=='),base64_decode('cGFja'.'w=='),base64_decode('bW'.'Q'.'1'),base64_decode('Y'.'29uc3Rh'.'bnQ='),base64_decode('a'.'GFzaF9'.'obWF'.'j'),base64_decode('c'.'3Ry'.'Y21'.'w'),base64_decode('aXN'.'fb2JqZWN0'),base64_decode('Y2Fs'.'bF'.'91c2VyX2Z1'.'bm'.'M='),base64_decode('Y2FsbF91c2Vy'.'X2Z1bmM'.'='),base64_decode('Y2FsbF91c'.'2VyX2'.'Z1'.'bmM='),base64_decode('Y'.'2FsbF'.'91'.'c2VyX2Z1bmM='),base64_decode('Y2Fsb'.'F91c2'.'VyX2'.'Z'.'1bm'.'M='));if(!function_exists(__NAMESPACE__.'\\___1832480445')){function ___1832480445($_1496472290){static $_731113232= false; if($_731113232 == false) $_731113232=array('LQ==','b'.'WFpbg'.'==','bWFp'.'bg='.'=','LQ==','bWFpbg==',''.'flBBUkFNX'.'0'.'1BWF9VU0V'.'SUw==','L'.'Q'.'='.'=','bWFp'.'bg==',''.'f'.'l'.'BBUkF'.'NX01BWF9VU0VSU'.'w==','Lg'.'==','SCo=',''.'Yml0cml'.'4','TElDRU5T'.'R'.'V9LR'.'Vk=','c2hhMjU2','LQ==','bWF'.'p'.'b'.'g==','fl'.'B'.'BUkFNX01B'.'WF9V'.'U0VS'.'Uw==','LQ='.'=','bWFpbg==','UEFSQU'.'1'.'fTU'.'FYX'.'1'.'VT'.'RVJ'.'T','V'.'VNFUg==',''.'VV'.'NFUg='.'=','V'.'VNFUg==','SXNB'.'dXRob'.'3Jp'.'emVk',''.'V'.'VNF'.'Ug==','S'.'XNB'.'ZG1'.'pbg==','QV'.'BQ'.'TE'.'lDQ'.'VRJT'.'04=','UmVzd'.'GFydEJ1'.'ZmZlcg==',''.'TG9jY'.'WxSZWR'.'p'.'cmVjd'.'A='.'=','L2xpY2Vuc2Vf'.'cm'.'Vz'.'dHJ'.'pY'.'3R'.'pb24ucGhw',''.'L'.'Q==','bWF'.'p'.'bg==',''.'flBBUkF'.'NX'.'0'.'1BWF9VU'.'0VSUw==',''.'LQ==','bW'.'F'.'pbg==','UE'.'FSQ'.'U1fT'.'UFYX'.'1VTRVJT','X'.'EJp'.'dHJpeF'.'xNYW'.'luX'.'E'.'NvbmZpZ1xPcHR'.'pb'.'246OnNldA==','b'.'WF'.'pbg==',''.'UE'.'FSQU1fT'.'UFYX1'.'V'.'TR'.'V'.'JT');return base64_decode($_731113232[$_1496472290]);}};if(isset(self::$options[___1832480445(0)][___1832480445(1)]) && $moduleId === ___1832480445(2)){ if(isset(self::$options[___1832480445(3)][___1832480445(4)][___1832480445(5)])){ $_1240765761= self::$options[___1832480445(6)][___1832480445(7)][___1832480445(8)]; list($_2102467124, $_291973878)= $GLOBALS['____1955166895'][0](___1832480445(9), $_1240765761); $_1259330924= $GLOBALS['____1955166895'][1](___1832480445(10), $_2102467124); $_1243254735= ___1832480445(11).$GLOBALS['____1955166895'][2]($GLOBALS['____1955166895'][3](___1832480445(12))); $_1884477408= $GLOBALS['____1955166895'][4](___1832480445(13), $_291973878, $_1243254735, true); self::$options[___1832480445(14)][___1832480445(15)][___1832480445(16)]= $_291973878; self::$options[___1832480445(17)][___1832480445(18)][___1832480445(19)]= $_291973878; if($GLOBALS['____1955166895'][5]($_1884477408, $_1259330924) !== min(66,0,22)){ if(isset($GLOBALS[___1832480445(20)]) && $GLOBALS['____1955166895'][6]($GLOBALS[___1832480445(21)]) && $GLOBALS['____1955166895'][7](array($GLOBALS[___1832480445(22)], ___1832480445(23))) &&!$GLOBALS['____1955166895'][8](array($GLOBALS[___1832480445(24)], ___1832480445(25)))){ $GLOBALS['____1955166895'][9](array($GLOBALS[___1832480445(26)], ___1832480445(27))); $GLOBALS['____1955166895'][10](___1832480445(28), ___1832480445(29), true);} return;}} else{ self::$options[___1832480445(30)][___1832480445(31)][___1832480445(32)]= round(0+6+6); self::$options[___1832480445(33)][___1832480445(34)][___1832480445(35)]= round(0+6+6); $GLOBALS['____1955166895'][11](___1832480445(36), ___1832480445(37), ___1832480445(38), round(0+3+3+3+3)); return;}}/**/
	}

	/**
	 * Sets an option value and saves it into a DB. After saving the OnAfterSetOption event is triggered.
	 *
	 * @param string $moduleId The module ID.
	 * @param string $name The option name.
	 * @param string $value The option value.
	 * @param string $siteId The site ID, if the option depends on a site.
	 * @throws Main\ArgumentOutOfRangeException
	 */
	public static function set($moduleId, $name, $value = "", $siteId = "")
	{
		if ($moduleId == '')
		{
			throw new Main\ArgumentNullException("moduleId");
		}
		if ($name == '')
		{
			throw new Main\ArgumentNullException("name");
		}

		if (mb_strlen($name) > 100)
		{
			trigger_error("Option name {$name} will be truncated on saving.", E_USER_WARNING);
		}

		if ($siteId === false)
		{
			$siteId = static::getDefaultSite();
		}

		$con = Main\Application::getConnection();
		$sqlHelper = $con->getSqlHelper();

		$updateFields = [
			"VALUE" => $value,
		];

		if($siteId == "")
		{
			$insertFields = [
				"MODULE_ID" => $moduleId,
				"NAME" => $name,
				"VALUE" => $value,
			];

			$keyFields = ["MODULE_ID", "NAME"];

			$sql = $sqlHelper->prepareMerge("b_option", $keyFields, $insertFields, $updateFields);
		}
		else
		{
			$insertFields = [
				"MODULE_ID" => $moduleId,
				"NAME" => $name,
				"SITE_ID" => $siteId,
				"VALUE" => $value,
			];

			$keyFields = ["MODULE_ID", "NAME", "SITE_ID"];

			$sql = $sqlHelper->prepareMerge("b_option_site", $keyFields, $insertFields, $updateFields);
		}

		$con->queryExecute(current($sql));

		static::clearCache($moduleId);

		static::loadTriggers($moduleId);

		$event = new Main\Event(
			"main",
			"OnAfterSetOption_".$name,
			array("value" => $value)
		);
		$event->send();

		$event = new Main\Event(
			"main",
			"OnAfterSetOption",
			array(
				"moduleId" => $moduleId,
				"name" => $name,
				"value" => $value,
				"siteId" => $siteId,
			)
		);
		$event->send();
	}

	protected static function loadTriggers($moduleId)
	{
		static $triggersCache = [];

		if (isset($triggersCache[$moduleId]))
		{
			return;
		}

		if (preg_match("#[^a-zA-Z0-9._]#", $moduleId))
		{
			throw new Main\ArgumentOutOfRangeException("moduleId");
		}

		$triggersCache[$moduleId] = true;

		$path = Main\Loader::getLocal("modules/".$moduleId."/option_triggers.php");
		if ($path === false)
		{
			return;
		}

		include($path);
	}

	protected static function getCacheTtl()
	{
		static $cacheTtl = null;

		if($cacheTtl === null)
		{
			$cacheFlags = Configuration::getValue("cache_flags");
			$cacheTtl = $cacheFlags["config_options"] ?? 3600;
		}
		return $cacheTtl;
	}

	/**
	 * Deletes options from a DB.
	 *
	 * @param string $moduleId The module ID.
	 * @param array $filter {name: string, site_id: string} The array with filter keys:
	 * 		name - the name of the option;
	 * 		site_id - the site ID (can be empty).
	 * @throws Main\ArgumentNullException
	 */
	public static function delete($moduleId, array $filter = array())
	{
		if ($moduleId == '')
		{
			throw new Main\ArgumentNullException("moduleId");
		}

		$con = Main\Application::getConnection();
		$sqlHelper = $con->getSqlHelper();

		$deleteForSites = true;
		$sqlWhere = $sqlWhereSite = "";

		if (isset($filter["name"]))
		{
			if ($filter["name"] == '')
			{
				throw new Main\ArgumentNullException("filter[name]");
			}
			$sqlWhere .= " AND NAME = '{$sqlHelper->forSql($filter["name"])}'";
		}
		if (isset($filter["site_id"]))
		{
			if($filter["site_id"] <> "")
			{
				$sqlWhereSite = " AND SITE_ID = '{$sqlHelper->forSql($filter["site_id"], 2)}'";
			}
			else
			{
				$deleteForSites = false;
			}
		}
		if($moduleId == 'main')
		{
			$sqlWhere .= "
				AND NAME NOT LIKE '~%'
				AND NAME NOT IN ('crc_code', 'admin_passwordh', 'server_uniq_id','PARAM_MAX_SITES', 'PARAM_MAX_USERS')
			";
		}
		else
		{
			$sqlWhere .= " AND NAME <> '~bsm_stop_date'";
		}

		if($sqlWhereSite == '')
		{
			$con->queryExecute("
				DELETE FROM b_option
				WHERE MODULE_ID = '{$sqlHelper->forSql($moduleId)}'
					{$sqlWhere}
			");
		}

		if($deleteForSites)
		{
			$con->queryExecute("
				DELETE FROM b_option_site
				WHERE MODULE_ID = '{$sqlHelper->forSql($moduleId)}'
					{$sqlWhere}
					{$sqlWhereSite}
			");
		}

		static::clearCache($moduleId);
	}

	protected static function clearCache($moduleId)
	{
		unset(self::$options[$moduleId]);

		if (static::getCacheTtl() !== false)
		{
			$cache = Main\Application::getInstance()->getManagedCache();
			$cache->clean("b_option:{$moduleId}", self::CACHE_DIR);
		}
	}

	protected static function getDefaultSite()
	{
		static $defaultSite;

		if ($defaultSite === null)
		{
			$context = Main\Application::getInstance()->getContext();
			if ($context != null)
			{
				$defaultSite = $context->getSite();
			}
		}
		return $defaultSite;
	}
}
