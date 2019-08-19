<?php

namespace BrauneDigital\MessageBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteable;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @Gedmo\SoftDeleteable()
 */
abstract class BaseRecipient {
    use SoftDeleteable;
    use TimestampableEntity;

    /**
     * @var \DateTime|null
     */
    protected $readAt = null;

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
}
