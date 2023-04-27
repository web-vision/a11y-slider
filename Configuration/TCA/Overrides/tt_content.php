<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

(function () {
    $languageFilePrefix = 'LLL:EXT:fluid_styled_content/Resources/Private/Language/Database.xlf:';
    $customLanguageFilePrefix = 'LLL:EXT:a11y_slider/Resources/Private/Language/locallang_be.xlf:';
    $frontendLanguageFilePrefix = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:';

    // Add the CType "wv_slider"
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:a11y_slider/Resources/Private/Language/locallang_be.xlf:wizard.title',
            'a11y_slider',
            'content-image'
        ],
        'textmedia',
        'after'
    );

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['a11y_slider'] = $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['textpic'];

    // Define what fields to display
    $GLOBALS['TCA']['tt_content']['types']['a11y_slider'] = [
        'showitem' => '
                --palette--;' . $frontendLanguageFilePrefix . 'palette.general;general,
                --palette--;' . $languageFilePrefix . 'tt_content.palette.mediaAdjustments;mediaAdjustments,
                pi_flexform,
            --div--;' . $customLanguageFilePrefix . 'tca.tab.sliderElements,
            image
        ',
        'columnsOverrides' => [
            'image' => [
                'label'  => $languageFilePrefix . 'tt_content.media_references',
                'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('media', [
                    'appearance'    => [
                        'createNewRelationLinkTitle' => $languageFilePrefix . 'tt_content.media_references.addFileReference'
                    ],
                ], $GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'])
            ]
        ]
    ];

    // Add a flexform to the wv_slider CType
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
        '16:7' => [
            'title' => '16:7',
            'value' => 16 / 7
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
