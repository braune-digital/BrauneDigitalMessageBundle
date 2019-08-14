<?php

namespace BrauneDigital\MessageBundle\Entity;

abstract class BaseMessage {

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $tags;

    /**
     * @var String
     */
    protected $content;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $subject;

    public function __construct() {
        $this->createdAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setDate($createdAt): void {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content): void {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getSubject(): string {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject): void {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getTags(): string {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags(string $tags): void {
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }
}
