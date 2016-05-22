<?php

namespace BrauneDigital\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

abstract class BaseConversation {

    /**
     * @var ArrayCollection
     */
    protected $members;

    /**
     * @var String
     */
    protected $subject;

    /**
     * @var ArrayCollection
     */
    protected $messages;

    /**
     * @var \DateTime
     */
    protected $created;
    public function __construct() {
        $this->members = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->created = new \DateTime();
    }

    /**
     * @return String
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param String $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param ArrayCollection $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /**
     * @param $member BaseUserHasConversation
     */
    public function addMember($member) {
        if(!$this->members->contains($member)) {
            $this->members->add($member);
        }
    }

    /**
     * @param $member BaseUserHasConversation
     */
    public function removeMember($member) {
        $this->members->remove($member);
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
     * @param $message BaseUserHasMessage
     */
    public function addMessage($message) {
        if(!$this->messages->contains($message)) {
            $this->messages->add($message);
        }
    }

    /**
     * @param $message UserHasMessage
     */
    public function removeMessage($message) {
        $this->messages->remove($message);
    }
}