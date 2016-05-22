<?php

namespace BrauneDigital\MessageBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

abstract class BaseUserHasMessage {

    protected $user;

    /**
     * @var BaseMessage
     */
    protected $message;

    /**
     * @var boolean
     */
    protected $wasRead = null;


    protected $conversation;

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return BaseMessage
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param BaseMessage $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return boolean
     */
    public function isWasRead()
    {
        return $this->wasRead;
    }

    /**
     * @param boolean $wasRead
     */
    public function setWasRead($wasRead)
    {
        if ($wasRead === false) {
            $this->wasRead = null;
        } else if ($wasRead === true) {
            $this->wasRead = new \DateTime();
        } else {
            $this->wasRead = $wasRead;
        }
    }

    /**
     * @return BaseConversation
     */
    public function getConversation() {
        return $this->conversation;
    }

    /**
     * @param BaseConversation $conversation
     */
    public function setConversation($conversation) {
        $this->conversation = $conversation;

        if ($conversation) {
            $conversation->addMessage($this);
        }
    }
}