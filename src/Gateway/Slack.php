<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle\Gateway;

use GuzzleHttp\Client;
use NotificationCenter\Gateway\Base;
use NotificationCenter\Gateway\GatewayInterface;
use NotificationCenter\MessageDraft\MessageDraftFactoryInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use Trilobit\CollaborationtoolnotificationBundle\MessageDraft\SlackMessageDraft;

class Slack extends Base implements GatewayInterface, MessageDraftFactoryInterface
{
    public function send(
        Message $objMessage,
        array $arrTokens,
        $strLanguage = '',
    ) {
        /**
         * @var SlackMessageDraft $objDraft
         */
        $objDraft = $this->createDraft($objMessage, $arrTokens, $strLanguage);

        if (null === $objDraft) {
            return false;
        }

        try {
            return $this->sendDraft($objDraft);
        } catch (\Exception $e) {
        }

        return false;
    }

    public function sendDraft(SlackMessageDraft $objDraft)
    {
        $client = new Client();

        // Setup message payload
        $payload = new \stdClass();

        $channel = $objDraft->getChannel();
        if ('' !== $objDraft->getChannel()) {
            $payload->channel = $objDraft->getChannel();
        }

        $username = $objDraft->getUsername();
        if ('' !== $username) {
            $payload->username = $username;
        }

        $payload->text = $objDraft->getText();

        // Send message
        $response = $client->post($this->objModel->slack_webhook, [
            'json' => $payload,
        ]);

        return 200 === $response->getStatusCode();
    }

    public function createDraft(Message $objMessage, array $arrTokens, $strLanguage = '')
    {
        if ('' === $strLanguage) {
            $strLanguage = $GLOBALS['TL_LANGUAGE'];
        }

        if (null === ($objLanguage = Language::findByMessageAndLanguageOrFallback($objMessage, $strLanguage))) {
            return;
        }

        return new SlackMessageDraft($objMessage, $objLanguage, $arrTokens);
    }
}
