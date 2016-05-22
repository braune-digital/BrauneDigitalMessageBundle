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
     * @var ArrayCollection
     */
    protected $admins;

    /**
     * @var String
     */
    protected $subject;

    /**
     * @var ArrayCollection
     */
    protected $messages;

    public function __construct() {
        $this->members = new ArrayCollection();
        $this->admins = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * @param $member UserHasMessage
     */
    public function addMember($member) {
        if(!$this->members->contains($member)) {
            $this->members->add($member);
        }
    }

    /**
     * @param $member UserHasMessage
     */
    public function removeMember($member) {
        $this->members->remove($member);
    }

    /**
     * @return ArrayCollection
     */
    public function getAdmins()
    {
        return $this->admins;
    }

    /**
     * @param ArrayCollection $admins
     */
    public function setAdmins($admins)
    {
        $this->admins = $admins;
    }


    /**
     * @param $admin UserHasMessage
     */
    public function addAdmin($admin) {
        if(!$this->admins->contains($admin)) {
            $this->admins->add($admin);
        }
    }

    /**
     * @param $admin UserHasMessage
     */
    public function removeAdmin($admin) {
        $this->admins->remove($admin);
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
     * @param $message UserHasMessage
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