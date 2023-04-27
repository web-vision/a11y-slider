<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:a11y_slider/Configuration/TsConfig/Page/All.tsconfig">'
);
