<?php

/**
 * notification_center extension for Contao Open Source CMS
 *
 * @copyright  Copyright (c) 2008-2015, terminal42
 * @author     terminal42 gmbh <info@terminal42.ch>
 * @license    LGPL
 */

namespace Trilobit\CollaborationtoolnotificationBundle\MessageDraft;

use Contao\Controller;
use NotificationCenter\MessageDraft\MessageDraftInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use NotificationCenter\Util\StringUtil;

class JetBrainsSpaceMessageDraft implements MessageDraftInterface
{
    protected $objMessage = null;

    protected $objLanguage = null;

    protected $arrTokens = array();

    public function __construct(Message $objMessage, Language $objLanguage, $arrTokens)
    {
        $this->arrTokens   = $arrTokens;
        $this->objLanguage = $objLanguage;
        $this->objMessage  = $objMessage;
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

    public function getText()
    {
        $strText = $this->objLanguage->space_text;
        $strText = \Haste\Util\StringUtil::recursiveReplaceTokensAndTags($strText, $this->arrTokens, StringUtil::NO_TAGS);

        return Controller::convertRelativeUrls($strText, '', true);
    }

    public function getUrl()
    {
        return $this->getMessage()->space_url;
    }

    public function getChannel()
    {
        return $this->getMessage()->space_channel;
    }

    public function getClientId()
    {
        return $this->getMessage()->space_client_id;
    }

    public function getClientSecret()
    {
        return $this->getMessage()->space_client_secret;
    }
}
