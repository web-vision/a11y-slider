<?php

(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '@import "EXT:a11y_slider/Configuration/TsConfig/Page/All.tsconfig"'
    );
})();
