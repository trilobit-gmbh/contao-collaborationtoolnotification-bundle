<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

use Trilobit\CollaborationtoolnotificationBundle\Gateway\JetBrainsSpace;
use Trilobit\CollaborationtoolnotificationBundle\Gateway\Slack;

$GLOBALS['NOTIFICATION_CENTER']['GATEWAY']['space'] = JetBrainsSpace::class;
$GLOBALS['NOTIFICATION_CENTER']['GATEWAY']['slack'] = Slack::class;

$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'] = array_merge_recursive(
    (array) $GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE'],
    [
        'contao' => [
            'core_form' => [
                'space_text' => ['form_*', 'formconfig_*', 'formlabel_*', 'raw_data', 'admin_email'],
                'slack_text' => ['form_*', 'formconfig_*', 'formlabel_*', 'raw_data', 'admin_email'],
            ],
            'member_activation' => [
                'space_text' => ['domain', 'member_*', 'admin_email'],
                'slack_text' => ['domain', 'member_*', 'admin_email'],
            ],
            'member_registration' => [
                'space_text' => ['domain', 'link', 'member_*', 'admin_email'],
                'slack_text' => ['domain', 'link', 'member_*', 'admin_email'],
            ],
            'member_personaldata' => [
                'space_text' => ['domain', 'member_*', 'member_old_*', 'changed_*', 'admin_email'],
                'slack_text' => ['domain', 'member_*', 'member_old_*', 'changed_*', 'admin_email'],
            ],
            'member_password' => [
                'space_text' => ['domain', 'link', 'member_*', 'recipient_email'],
                'slack_text' => ['domain', 'link', 'member_*', 'recipient_email'],
            ],
        ],
    ]
);
