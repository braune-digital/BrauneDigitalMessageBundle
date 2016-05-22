<?php

namespace BrauneDigital\MessageBundle\Entity;

use Knp\DoctrineBehaviors\Model as ORMBehaviors;

abstract class BaseDirectMessage extends Message {
    /**
     * @var string
     */
    protected $subject;

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
}