<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['__selector__'][] = 'space_mode';
$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['__selector__'][] = 'slack_mode';

$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['space'] = '{general_legend},language,fallback;'
    .'{content_legend},space_text;';

$GLOBALS['TL_DCA']['tl_nc_language']['palettes']['slack'] = '{general_legend},language,fallback;'
    .'{content_legend},slack_text;';

$GLOBALS['TL_DCA']['tl_nc_language']['fields']['space_text'] = [
    'inputType' => 'textarea',
    'eval' => ['rgxp' => 'nc_tokens', 'allowHtml' => false, 'decodeEntities' => true, 'mandatory' => true],
    'sql' => 'text NULL',
];

$GLOBALS['TL_DCA']['tl_nc_language']['fields']['slack_text'] = [
    'inputType' => 'textarea',
    'eval' => ['rgxp' => 'nc_tokens', 'allowHtml' => false, 'decodeEntities' => true, 'mandatory' => true],
    'sql' => 'text NULL',
];
