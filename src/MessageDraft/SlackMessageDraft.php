<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle\MessageDraft;

use Contao\Controller;
use NotificationCenter\MessageDraft\MessageDraftInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use NotificationCenter\Util\StringUtil;

class SlackMessageDraft implements MessageDraftInterface
{
    protected $objMessage = null;

    protected $objLanguage = null;

    protected $arrTokens = [];

    public function __construct(Message $objMessage, Language $objLanguage, $arrTokens)
    {
        $this->arrTokens = $arrTokens;
        $this->objLanguage = $objLanguage;
        $this->objMessage = $objMessage;
    }

    public function getTokens()
    {
        return $this->arrTokens;
    }

    public function getMessage()
    {
        return $this->objMessage;
    }

    public function getLanguage()
    {
        return $this->objLanguage->language;
    }

    public function getUsername()
    {
        return $this->getMessage()->slack_username;
    }

    public function getChannel()
    {
        return $this->getMessage()->slack_channel;
    }

    public function getText()
    {
        $strText = $this->objLanguage->slack_text;
        $strText = \Haste\Util\StringUtil::recursiveReplaceTokensAndTags($strText, $this->arrTokens, StringUtil::NO_TAGS);

        return Controller::convertRelativeUrls($strText, '', true);
    }
}
