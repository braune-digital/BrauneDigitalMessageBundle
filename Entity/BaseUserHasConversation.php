<?php

namespace BrauneDigital\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

abstract class BaseUserHasConversation {

    protected $user;

    /**
     * @var BaseConversation
     */
    protected $conversation;

    /**
     * @var \DateTime
     */
    protected $joinedOn;

    /**
     * @var \DateTime
     */
    protected $leftOn;

    /**
     * @var boolean
     */
    protected $active = true;

    /**
     * @var boolean
     */
    protected $isAdmin = false;

    protected $messages;

    protected $unreadMessages;

    public function __construct() {
        $this->joinedOn = new \DateTime();
        $this->messages = new ArrayCollection();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
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
    }


    /**
     * @return boolean
     */
    public function isActive() {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active) {
        $this->active = $active;
    }

    /**
     * @return boolean
     */
    public function isAdmin() {
        return $this->isAdmin;
    }

    /**
     * @return boolean
     */
    public function isIsAdmin() {
        return $this->isAdmin && $this->active;
    }

    /**
     * @param boolean $isAdmin
     */
    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return \DateTime
     */
    public function getJoinedOn() {
        return $this->joinedOn;
    }

    /**
     * @param \DateTime $joinedOn
     */
    public function setJoinedOn($joinedOn) {
        $this->joinedOn = $joinedOn;
    }

    /**
     * @return \DateTime
     */
    public function getLeftOn() {
        return $this->leftOn;
    }

    /**
     * @param \DateTime $leftOn
     */
    public function setLeftOn($leftOn) {
        $this->leftOn = $leftOn;
    }

    /**
     * @return ArrayCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param ArrayCollection $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }


    /**
     * @param $message BaseRecipient
     */
    public function addMessage($message) {
        if(!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setConversation($this);
        }
    }

    /**
     * @param $message
     */
    public function removeMessage($message) {
        $this->messages->remove($message);
    }

    public function getUnreadMessages() {
        if (!$this->unreadMessages) {
            $unreadCriteria = Criteria::create();
            $unreadCriteria->where(Criteria::expr()->eq('wasRead', null));
            $this->unreadMessages = $this->messages->matching($unreadCriteria);
        }
        return $this->unreadMessages;
    }
}
