<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Rtehtmlarea\\Form\\Element\\RichTextElement'] = array(
    'className' => 'TYPO3\\CMS\\AdRtepasteplain\\Xclass\\RichTextElement',
);