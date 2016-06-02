<?php
namespace BrauneDigital\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author    Patrick Rathje <pr@braune-digital.com>
 * @copyright 2016 Braune Digital GmbH
 */
trait UserTrait {

    protected $sentMessages;

    protected $messages;

    protected $conversations;

    protected $unreadMessages;

    protected function initUserTrait() {
        $this->sentMessages = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
    }


    /**
     * @return ArrayCollection
     */
    public function getSentMessages() {
        return $this->sentMessages;
    }

    /**
     * @param ArrayCollection $sentMessages
     */
    public function setSentMessages($sentMessages) {
        $this->sentMessages = $sentMessages;
    }

    /**
     * @param Message
     */
    public function addSentMessage($msg) {
        if(!$this->sentMessages->contains($msg)) {
            $this->sentMessages->add($msg);
        }
    }

    /**
     * @param Message
     */
    public function removeSentMessage($msg) {
        $this->sentMessages->removeElement($msg);
    }


    /**
     * @return ArrayCollection
     */
    public function getMessages() {
        return $this->messages;
    }

    /**
     * @param ArrayCollection $messages
     */
    public function setMessages($messages) {
        $this->messages = $messages;
    }

    /**
     * @param UserHasMessage
     */
    public function addMessage($msg) {
        if(!$this->messages->contains($msg)) {
            $this->messages->add($msg);

        }
    }

    /**
     * @param UserHasMessage
     */
    public function removeMessage($msg) {
        $this->messages->removeElement($msg);
    }

    /**
     * @return ArrayCollection
     */
    public function getConversations() {
        return $this->conversations;
    }

    /**
     * @param ArrayCollection $cccs
     */
    public function setConversations($conversations) {
        $this->conversations = $conversations;
    }

    /**
     * @param UserHasConversation
     */
    public function addConversation($conversation) {
        if(!$this->conversations->contains($conversation)) {
            $this->conversations->add($conversation);
        }
    }

    /**
     * @param UserHasConversation
     */
    public function removeConversation($conversation) {
        $this->conversations->removeElement($conversation);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|static
     */
    public function getUnreadMessages() {
        if (!$this->unreadMessages) {
            $unreadCriteria = Criteria::create();
            $unreadCriteria->where(Criteria::expr()->eq('wasRead', null));
            $this->unreadMessages = $this->messages->matching($unreadCriteria);
        }
        return $this->unreadMessages;
    }
}