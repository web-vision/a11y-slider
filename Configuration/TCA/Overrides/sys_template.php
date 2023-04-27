<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}
(function () {
    $extensionKey = 'a11y_slider';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'A11ySlider'
    );
})();
