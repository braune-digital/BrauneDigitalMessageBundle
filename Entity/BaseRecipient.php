<?php

namespace BrauneDigital\MessageBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteable;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @Gedmo\SoftDeleteable()
 * @ORM\MappedSuperclass()
 */
abstract class BaseRecipient {
    use SoftDeleteable;
    use TimestampableEntity;

    /**
     * @var \DateTime
     */
    protected $readAt = null;

    /**
     * @return \DateTime
     */
    public function isRead(): \DateTime {
        return $this->readAt;
    }

    /**
     * @param boolean $isRead
     * @throws \Exception
     */
    public function setRead($isRead): void {
        if ($isRead === false) {
            $this->readAt = null;
        } else if ($isRead === true) {
            $this->readAt = new \DateTime();
        } else {
            $this->readAt = $isRead;
        }
    }
}
