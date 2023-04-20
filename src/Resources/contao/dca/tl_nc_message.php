<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

$GLOBALS['TL_DCA']['tl_nc_message']['palettes']['space'] = '{title_legend},title,gateway;'
    .'{languages_legend},languages;'
    .'{expert_legend:hide},space_url,space_channel,space_client_id,space_client_secret;'
    .'{publish_legend},published;';

$GLOBALS['TL_DCA']['tl_nc_message']['palettes']['slack'] = '{title_legend},title,gateway;'
    .'{languages_legend},languages;'
    .'{expert_legend:hide},slack_username,slack_channel;'
    .'{publish_legend},published;';

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_url'] = [
    'inputType' => 'text',
    'eval' => ['maxLength' => 255, 'rgxp' => 'url', 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_channel'] = [
    'inputType' => 'text',
    'eval' => ['maxLength' => 255, 'tl_class' => 'w50',],
    'sql' => "VARCHAR(255) NOT NULL default ''",
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_client_id'] = [
    'inputType' => 'text',
    'eval' => ['maxLength' => 256, 'rgxp' => 'url', 'tl_class' => 'w50'],
    'sql' => "VARCHAR(2048) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_nc_message']['fields']['space_client_secret'] = [
    'inputType' => 'text',
    'eval' => ['maxLength' => 256, 'rgxp' => 'url', 'tl_class' => 'w50'],
    'sql' => "VARCHAR(2048) NOT NULL default ''",
];
$GLOBALS['TL_DCA']['tl_nc_message']['fields']['slack_username'] = [
    'inputType' => 'text',
    'eval' => ['tl_class' => 'w50', 'maxLength' => 255],
    'sql' => "VARCHAR(255) NOT NULL DEFAULT ''",
];

$GLOBALS['TL_DCA']['tl_nc_message']['fields']['slack_channel'] = [
    'inputType' => 'text',
    'eval' => ['tl_class' => 'w50', 'maxLength' => 255],
    'sql' => "VARCHAR(255) NOT NULL DEFAULT ''",
];
