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
}