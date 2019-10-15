<?php


namespace BrauneDigital\MessageBundle\Entity;


use FOS\UserBundle\Model\UserInterface;

abstract class BaseConversationMessage extends BaseMessage {

    /**
     * @var BaseConversation
     */
    protected $conversation;

    /**
     * @var UserInterface
     */
    protected $by;

    /**
     * @return BaseConversation
     */
    public function getConversation(): ?BaseConversation {
        return $this->conversation;
    }

    /**
     * @return UserInterface
     */
    public function getBy(): ?UserInterface
    {
        return $this->by;
    }

    /**
     * @param UserInterface $by
     */
    public function setBy(UserInterface $by): void
    {
        $this->by = $by;
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
