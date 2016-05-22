<?php

namespace BrauneDigital\MessageBundle\Entity;

abstract class BaseConversationMessage extends Message {

    protected $by;

    protected $conversation;

    /**
     * @return mixed
     */
    public function getBy() {
        return $this->by;
    }

    /**
     * @param mixed $by
     */
    public function setBy($by) {
        $this->by = $by;
    }

    /**
     * @return mixed
     */
    public function getConversation() {
        return $this->conversation;
    }

    /**
     * @param mixed $conversation
     */
    public function setConversation($conversation) {
        $this->conversation = $conversation;
    }
}