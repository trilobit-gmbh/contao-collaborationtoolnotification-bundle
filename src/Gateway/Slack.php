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
use PresProg\SlackNotification\MessageDraft\SlackMessageDraft;

/**
 * Class Slack.
 * {@inheritDoc}
 */
class Slack extends Base implements GatewayInterface, MessageDraftFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function send(
        Message $objMessage,
        array $arrTokens,
        $strLanguage = ''
    ) {
        /**
         * @var SlackMessageDraft $objDraft
         */
        $objDraft = $this->createDraft($objMessage, $arrTokens, $strLanguage);

        // return false if no language found for BC
        if (null === $objDraft) {
            \System::log(sprintf('Could not create draft message for slack notification (Message ID: %s)', $objMessage->id), __METHOD__, TL_ERROR);

            return false;
        }

        try {
            return $this->sendDraft($objDraft);
        } catch (\Exception $e) {
            \System::log(sprintf('Could not send slack notification for message ID %s: %s', $objMessage->id, $e->getMessage()), __METHOD__, TL_ERROR);
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

    /**
     * {@inheritDoc}
     */
    public function createDraft(
        Message $objMessage,
        array $arrTokens,
        $strLanguage = ''
    ) {
        if ('' === $strLanguage) {
            $strLanguage = $GLOBALS['TL_LANGUAGE'];
        }

        if (($objLanguage = Language::findByMessageAndLanguageOrFallback($objMessage,
            $strLanguage)) === null
        ) {
            \System::log(sprintf('Could not find matching language or fallback for message ID "%s" and language "%s".',
                $objMessage->id, $strLanguage), __METHOD__, TL_ERROR);

            return;
        }

        return new SlackMessageDraft($objMessage, $objLanguage, $arrTokens);
    }
}
