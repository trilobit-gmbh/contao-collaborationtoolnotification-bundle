<?php

$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['space'] = '{title_legend},title,type;'
    .'{space_legend},space_url,space_channel,space_client_id,space_client_secret;';

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_url'] = [
    'inputType' => 'text',
    'eval' => [
        'mandatory' => true,
        'maxLength' => 255,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_channel'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 255,
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_client_id'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 256,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(2048) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_client_secret'] = [
    'inputType' => 'text',
    'eval' => [
        'maxLength' => 256,
        'rgxp' => 'url',
        'tl_class' => 'w50'
    ],
    'sql' => "VARCHAR(2048) NOT NULL default ''"
];
