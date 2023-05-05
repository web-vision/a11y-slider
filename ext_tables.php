<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

(static function (): void {
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class)
    ->registerIcon(
        'carousel-icon',
        TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
            'source' => 'EXT:a11y_slider/Resources/Public/Icons/carousel.svg',
        ]
    );
})();
