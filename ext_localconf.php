<?php

(static function (): void {

    $versionInformation = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Information\Typo3Version::class);
    // Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
    if ($versionInformation->getMajorVersion() < 12) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
      @import "EXT:a11y_slider/Configuration/TsConfig/Page/All.tsconfig"
   ');
    }
})();
