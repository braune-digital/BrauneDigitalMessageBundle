<?php


namespace BrauneDigital\MessageBundle\Entity;


abstract class BaseConversationMessage extends BaseMessage {

    /**
     * @var BaseConversation
     */
    protected $conversation;

    /**
     * @return BaseConversation
     */
    public function getConversation(): BaseConversation {
        return $this->conversation;
    }

    /**
     * @param BaseConversation $conversation
     */
    public function setConversation($conversation): void {
        $this->conversation = $conversation;

        if ($conversation) {
            $conversation->addMessage($this);
        }
    }

}
