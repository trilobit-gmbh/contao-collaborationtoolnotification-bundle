<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\CollaborationtoolnotificationBundle\MessageDraft;

use Codefog\HasteBundle\StringParser;
use Contao\Controller;
use Contao\System;
use NotificationCenter\MessageDraft\MessageDraftInterface;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;
use NotificationCenter\Util\StringUtil;

class SlackMessageDraft implements MessageDraftInterface
{
    protected $message;

    protected $language;

    protected $tokens = [];
    private ?object $stringParser;

    public function __construct(Message $message, Language $language, $tokens)
    {
        $this->tokens = $tokens;
        $this->language = $language;
        $this->message = $message;

        $this->stringParser = System::getContainer()->get(StringParser::class);
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getLanguage()
    {
        return $this->language->language;
    }

    public function getText()
    {
        $buffer = $this->language->slack_text;
        $buffer = $this->stringParser->recursiveReplaceTokensAndTags($buffer, $this->tokens, StringUtil::NO_TAGS);

        return Controller::convertRelativeUrls($buffer, '', true);
    }

    public function getUsername()
    {
        return $this->getMessage()->slack_username;
    }

    public function getChannel()
    {
        return $this->getMessage()->slack_channel;
    }
}
