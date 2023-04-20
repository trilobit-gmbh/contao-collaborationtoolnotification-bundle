<?php

$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['__selector__'][] = 'space_mode';

$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['space'] = '{general_legend},language,fallback;'
    .'{content_legend},space_text;';

$GLOBALS['TL_DCA']['tl_nc_language']['fields']['space_text'] = [
    'inputType' => 'textarea',
    'eval' => [
        'rgxp' => 'nc_tokens',
        'allowHtml' => false,
        'decodeEntities' => true,
        'mandatory' => true
    ],
    'sql' => "text NULL"
];
