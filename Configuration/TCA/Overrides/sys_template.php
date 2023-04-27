<?php

(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'a11y_slider',
        'Configuration/TypoScript',
        'A11y Slider'
    );
})();
