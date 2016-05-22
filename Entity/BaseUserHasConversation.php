<?php

namespace BrauneDigital\MessageBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

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

    public function __construct() {
        $this->joinedOn = new \DateTime();
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
}