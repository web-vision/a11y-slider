<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'a11y_slider',
    'description' => '',
    'state' => 'beta',
    'category' => 'fe',
    'author' => 'Riad',
    'author_email' => 'riad@web-vision.de',
    'author_company' => 'web-vision',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.99-13.4.99',
            'fluid_styled_content' => '11.5.99-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'WebVision\\A11ySlider\\' => 'Classes',
        ],
    ],
];
