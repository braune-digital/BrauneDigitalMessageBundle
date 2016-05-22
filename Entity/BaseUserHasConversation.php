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
    protected $joined;

    /**
     * @var \DateTime
     */
    protected $left;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var boolean
     */
    protected $isAdmin;

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
     * @return \DateTime
     */
    public function getJoined() {
        return $this->joined;
    }

    /**
     * @param \DateTime $joined
     */
    public function setJoined($joined) {
        $this->joined = $joined;
    }

    /**
     * @return \DateTime
     */
    public function getLeft() {
        return $this->left;
    }

    /**
     * @param \DateTime $left
     */
    public function setLeft($left) {
        $this->left = $left;
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
}