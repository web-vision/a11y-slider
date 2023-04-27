<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}
(function () {
    $extensionKey = 'a11y_slider';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'A11ySlider'
    );
})();
