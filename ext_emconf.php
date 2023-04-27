<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'a11y_slider',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.99',
            'fluid_styled_content' => '11.5.99',
            'rte_ckeditor' => '11.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'WebVision\\A11ySlider\\' => 'Classes',
        ],
    ],
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'author' => 'Riad',
    'author_email' => 'riad@web-vision.de',
    'author_company' => 'web-vision',
    'version' => '1.0.0',
];
