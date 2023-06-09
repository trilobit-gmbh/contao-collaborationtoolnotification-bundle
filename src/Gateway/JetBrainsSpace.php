<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle\Gateway;

use GuzzleHttp\Exception\GuzzleException;
use NotificationCenter\Gateway\Base;
use NotificationCenter\Gateway\GatewayInterface;
use NotificationCenter\MessageDraft\MessageDraftFactoryInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use Swe\SpaceSDK\Exception\MissingArgumentException;
use Swe\SpaceSDK\HttpClient;
use Swe\SpaceSDK\Space;
use Trilobit\CollaborationtoolnotificationBundle\MessageDraft\JetBrainsSpaceMessageDraft;

class JetBrainsSpace extends Base implements GatewayInterface, MessageDraftFactoryInterface
{
    public function send(Message $objMessage, array $arrTokens, $strLanguage = '')
    {
        /**
         * @var JetBrainsSpaceMessageDraft $objDraft
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

    /**
     * @throws GuzzleException
     * @throws MissingArgumentException
     */
    public function sendDraft(JetBrainsSpaceMessageDraft $objDraft): bool
    {
        $space = new Space(
            new HttpClient(
                $objDraft->getUrl() ?: $this->objModel->space_url,
                $objDraft->getClientId() ?: $this->objModel->space_client_id,
                $objDraft->getClientSecret() ?: $this->objModel->space_client_secret
            )
        );

        $data = [
            'channel' => 'channel:name:'.($objDraft->getChannel() ?: $this->objModel->space_channel),
            'content' => [
                'className' => 'ChatMessage.Text',
                'text' => $objDraft->getText(),
            ],
        ];

        $result = $space->chats()->messages()->sendMessage($data);

        return !empty($result) && isset($result['id']);
    }

    public function createDraft(Message $objMessage, array $arrTokens, $strLanguage = '')
    {
        if ('' === $strLanguage) {
            $strLanguage = $GLOBALS['TL_LANGUAGE'];
        }

        if (null === ($objLanguage = Language::findByMessageAndLanguageOrFallback($objMessage, $strLanguage))) {
            return;
        }

        return new JetBrainsSpaceMessageDraft($objMessage, $objLanguage, $arrTokens);
    }
}
