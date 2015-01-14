<?php
namespace In2code\AdRtepasteplain\Extension;

use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Class RemoveFormat
 *
 * @package In2code\AdRtepasteplain\Extension
 */
class RemoveFormat extends \TYPO3\CMS\Rtehtmlarea\Extension\RemoveFormat {

	/**
	 * @param $RTEcounter
	 * @return string
	 */
	public function buildJavascriptConfiguration($RTEcounter) {
		$this->insertJS();
		return parent::buildJavascriptConfiguration($RTEcounter);
	}

	/**
	 * Insert some JavaScript
	 *
	 * @return void
	 */
	protected function insertJS() {
		global $LANG;
		$LANG->includeLLFile("EXT:ad_rtepasteplain/locallang.xml");

		$extKey = 'ad_rtepasteplain';
		$extPath = ExtensionManagementUtility::extRelPath($extKey);

		$this->htmlAreaRTE->TCEform->additionalCode_pre["ux_tx_rtehtmlarea_removeformat"] = '
			<link rel="stylesheet" type="text/css" href="' . $extPath . 'res/helpers.css" />
			<script type="text/javascript" src="' . $extPath . 'res/pasteplain.js"></script>
			<script type="text/javascript">
				' . $extKey . '.labels               = {};
				' . $extKey . '.labels.layer         = {};
				' . $extKey . '.labels.layer.info    = \'' . addcslashes($LANG->getLL($extKey . ".layer.info"), "'/") . '\';
				' . $extKey . '.labels.layer.insert  = \'' . addcslashes($LANG->getLL($extKey . ".layer.insert"), "'/") . '\';
				' . $extKey . '.labels.layer.cancel  = \'' . addcslashes($LANG->getLL($extKey . ".layer.cancel"), "'/") . '\';
				' . $extKey . '.addEvent(window, "load", ad_rtepasteplain.init, false);
			</script>
		';
	}
}