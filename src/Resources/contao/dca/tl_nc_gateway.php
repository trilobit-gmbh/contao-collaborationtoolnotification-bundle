<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['space'] = '{title_legend},title,type;'
    .'{space_legend},space_url,space_channel,space_client_id,space_client_secret;';

$GLOBALS['TL_DCA']['tl_nc_gateway']['palettes']['slack'] = '{title_legend},title,type;'
    .'{slack_legend},slack_webhook,slack_channel;';

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_url'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxLength' => 255, 'rgxp' => 'url', 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_channel'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxLength' => 255, 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_client_id'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxLength' => 256, 'rgxp' => 'url', 'tl_class' => 'w50',],
    'sql' => "VARCHAR(2048) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['space_client_secret'] = [
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxLength' => 256, 'rgxp' => 'url', 'tl_class' => 'w50',],
    'sql' => "VARCHAR(2048) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['slack_webhook'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_nc_gateway']['slack_webhook'],
    'inputType' => 'text',
    'eval' => ['mandatory' => true, 'maxLength' => 255, 'rgxp' => 'url', 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_gateway']['fields']['slack_channel'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_nc_gateway']['slack_channel'],
    'inputType' => 'text',
    'eval' => ['maxLength' => 255, 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];
