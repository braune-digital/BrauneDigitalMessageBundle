<?php

namespace BrauneDigital\MessageBundle\Entity;

use App\Entity\Messaging\LUMessage;
use App\Model\IdAwareTrait;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteable;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @Gedmo\SoftDeleteable()
 */
abstract class BaseRecipient {
    use IdAwareTrait;
    use SoftDeleteable;
    use TimestampableEntity;

    /**
     * @var \DateTime|null
     */
    protected $readAt = null;

    /**
     * @var BaseMessage
     */
    protected $message;

    /**
     * @return BaseMessage
     */
    public function getMessage(): BaseMessage {
        return $this->message;
    }

    /**
     * @param BaseMessage $message
     */
    public function setMessage(BaseMessage $message): void {
        $this->message = $message;
    }

    /**
     * @return \DateTime
     */
    public function getReadAt() {
        return $this->readAt;
    }

    /**
     * @param boolean $readAt
     * @throws \Exception
     */
    public function setReadAt($readAt): void {
        if ($readAt === false) {
            $this->readAt = null;
        } else if ($readAt === true) {
            $this->readAt = new \DateTime();
        } else {
            $this->readAt = $readAt;
        }
    }

    public function isRead() {
        return $this->getReadAt() != null;
    }
}
