<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle\MessageDraft;

use NotificationCenter\MessageDraft\MessageDraftInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use NotificationCenter\Util\StringUtil;

/**
 * Class SlackMessageDraft.
 */
class SlackMessageDraft implements MessageDraftInterface
{
    /**
     * Message.
     *
     * @var Message
     */
    protected $objMessage = null;

    /**
     * Language.
     *
     * @var Language
     */
    protected $objLanguage = null;

    /**
     * Tokens.
     *
     * @var array
     */
    protected $arrTokens = [];

    /**
     * Construct the object.
     */
    public function __construct(
        Message $objMessage,
        Language $objLanguage,
        Tokens $arrTokens
    ) {
        $this->objMessage = $objMessage;
        $this->objLanguage = $objLanguage;
        $this->arrTokens = $arrTokens;
    }

    /**
     * {@inheritDoc}
     */
    public function getTokens()
    {
        return $this->arrTokens;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        return $this->objMessage;
    }

    /**
     * {@inheritDoc}
     */
    public function getLanguage()
    {
        return $this->objLanguage->language;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getMessage()->slack_username;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->getMessage()->slack_channel;
    }

    /**
     * @return string
     */
//    public function getIcon()
//    {
//        return $this->getMessage()->slack_icon;
//    }

    /**
     * @return string
     */
    public function getText()
    {
        $strText = $this->objLanguage->slack_text;

        return StringUtil::recursiveReplaceTokensAndTags($strText, $this->arrTokens, StringUtil::NO_TAGS);
    }
}
