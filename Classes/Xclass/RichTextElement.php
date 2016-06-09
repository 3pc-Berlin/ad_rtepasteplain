<?php
namespace TYPO3\CMS\AdRtepasteplain\Xclass;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class RichTextElement
 *
 * @package TYPO3\CMS\AdRtepasteplain\Extension
 */
class RichTextElement extends \TYPO3\CMS\Rtehtmlarea\Form\Element\RichTextElement
{

    /**
     * The extension key
     *
     * @var string
     */
    protected $extKey = 'ad_rtepasteplain';

    /**
     * Extends the rendering of RTE area form field
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render()
    {
        $this->resultArray = parent::render();
        $this->addConfigurationForExtAdRtepasteplain();
        return $this->resultArray;
    }

    /**
     * Add configuration for EXT:ad_rtepasteplain
     *
     * @return void
     */
    protected function addConfigurationForExtAdRtepasteplain()
    {
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFile(ExtensionManagementUtility::extRelPath($this->extKey) . 'Resources/Public/JavaScript/Default.js');
        $pageRenderer->addCssFile(ExtensionManagementUtility::extRelPath($this->extKey) . 'Resources/Public/Css/Default.css');
        $this->resultArray['additionalJavaScriptPost'][] = $this->getInlineJsConfigurationForExtAdRtepasteplain();
    }

    /**
     * Get inline JS configuration for EXT:ad_rtepasteplain
     * Returns JS with event and labels for current language
     *
     * @return string JS configuration
     */
    protected function getInlineJsConfigurationForExtAdRtepasteplain()
    {
        $LLFile = 'LLL:EXT:' . $this->extKey . '/Resources/Private/Language/locallang.xml';
        $jsArray[] = $this->extKey . '.labels = {};';
        $jsArray[] = $this->extKey . '.labels.layer = {};';
        $jsArray[] = $this->extKey . '.labels.layer.info    = \'' . addcslashes(LocalizationUtility::translate($LLFile .':layer.info', $this->extKey), "'/") . '\';';
        $jsArray[] = $this->extKey . '.labels.layer.insert  = \'' . addcslashes(LocalizationUtility::translate($LLFile .':layer.insert', $this->extKey), "'/") . '\';';
        $jsArray[] = $this->extKey . '.labels.layer.cancel  = \'' . addcslashes(LocalizationUtility::translate($LLFile .':layer.cancel', $this->extKey), "'/") . '\';';
        $jsArray[] = $this->extKey . '.addEvent(window, "load", ad_rtepasteplain.init, false);';
        return implode(LF, $jsArray);
    }
}