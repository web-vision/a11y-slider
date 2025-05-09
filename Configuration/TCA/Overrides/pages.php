<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}
(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        'a11y_slider',
        'Configuration/TsConfig/Page/All.tsconfig',
        'A11ySlider'
    );
})();
