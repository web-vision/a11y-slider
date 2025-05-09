<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'sys_file_reference',
        [
            'tx_a11y_slider_showtitle' => [
                'exclude' => 0,
                'label' => 'LLL:EXT:a11y_slider/Resources/Private/Language/locallang_be.xlf:slider.images.showTitle',
                'config' => [
                    'type' => 'check'
                ]
            ],
        ],
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'sys_file_reference',
        'tx_a11y_slider_showtitle',
        'a11y_slider',
        'after:title'
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'sys_file_reference',
        'imageoverlayPalette',
        'tx_a11y_slider_showtitle',
        'after:title'
    );
})();
