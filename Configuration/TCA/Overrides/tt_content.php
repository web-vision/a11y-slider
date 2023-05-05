<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

(static function (): void {
    $ll = function (string $langKey): string {
        return 'LLL:EXT:a11y_slider/Resources/Private/Language/locallang_be.xlf:' . $langKey;
    };

    $languageFilePrefix = 'LLL:EXT:fluid_styled_content/Resources/Private/Language/Database.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            $ll('slider.title'),
            'a11y_slider',
            'carousel-icon'
        ]
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['a11y_slider'] = 'carousel-icon';

    // Define what fields to display
    $GLOBALS['TCA']['tt_content']['types']['a11y_slider'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $languageFilePrefix . 'tt_content.palette.mediaAdjustments;mediaAdjustments,
                pi_flexform,
                --div--;' . $ll('tca.tab.sliderElements') .',
            image
        ',
    ];

    // Add a flexform to the a11y_slider CType
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '',
        'FILE:EXT:a11y_slider/Configuration/FlexForms/slider.xml',
        'a11y_slider'
    );
})();

/**
 * A11ySlider
 */
(function (string $contentElementName, string $table) {
    if (!isset($GLOBALS['TCA'][$table]['types'][$contentElementName]['columnsOverrides'])) {
        $GLOBALS['TCA'][$table]['types'][$contentElementName]['columnsOverrides'] = [];
    }

    $aspectRatios = [
        '19:7' => [
            'title' => '19:7',
            'value' => 19 / 7
        ],
    ];

    \TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA'][$table]['types'][$contentElementName]['columnsOverrides'],
        [
            'assets' => [
                'config' => [
                    'overrideChildTca' => [
                        'columns' => [
                            'crop' => [
                                'config' => [
                                    'cropVariants' => [
                                        'desktop' => [
                                            'title' => 'desktop',
                                            'allowedAspectRatios' => $aspectRatios
                                        ],
                                        'tablet' => [
                                            'title' => 'tablet',
                                            'allowedAspectRatios' => $aspectRatios
                                        ],
                                        'mobile' => [
                                            'title' => 'mobile',
                                            'allowedAspectRatios' => $aspectRatios
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ]
                ]
            ]
        ]
    );
})('a11y_slider', 'tt_content');
