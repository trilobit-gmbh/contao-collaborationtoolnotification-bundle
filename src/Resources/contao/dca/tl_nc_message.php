<?php

$GLOBALS['TL_DCA']['tl_nc_message']['palettes']['space'] = '{title_legend},title,gateway;'
    .'{languages_legend},languages;'
    .'{expert_legend:hide},space_url,space_channel,space_client_id,space_client_secret;'
    .'{publish_legend},published;';

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_url'] = [
    'inputType' => 'text',
    'eval' => [
        'mandatory' => true,
        'maxLength' => 255,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_channel'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 255,
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_client_id'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 256,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(2048) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_client_secret'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 256,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(2048) NOT NULL default ''"
];
