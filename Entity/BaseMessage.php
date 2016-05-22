<?php

namespace BrauneDigital\MessageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

abstract class BaseMessage {

    /**
     * @var ArrayCollection
     */
    protected $sendTo;

    /**
     * @var String
     */
    protected $text;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var string
     */
    protected $subject;

    protected $by;

    /**
     * @var BaseConversation
     */
    protected $conversation;

    public function __construct() {
        $this->sendTo = new ArrayCollection();
        $this->date = new \DateTime();
    }

    /**
     * @return ArrayCollection
     */
    public function getSendTo() {
        return $this->sendTo;
    }

    /**
     * @param ArrayCollection $sendTo
     */
    public function setSendTo($sendTo) {
        $this->sendTo = $sendTo;
    }

    public function addSendTo($userHasMessage) {
        if (!$this->sendTo->contains($userHasMessage)) {
            $this->sendTo->add($userHasMessage);
        }
    }

    public function removeSendTo($userHasMessage) {
        $this->sendTo->remove($userHasMessage);
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return String
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param String $text
     */
    public function setText($text) {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }

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