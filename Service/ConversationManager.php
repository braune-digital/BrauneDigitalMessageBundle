<?php
namespace BrauneDigital\MessageBundle\Service;

use Doctrine\ORM\EntityManager;

/**
 * @author    Patrick Rathje <pr@braune-digital.com>
 * @copyright 2016 Braune Digital GmbH
 */
class ConversationManager {

    protected $em;
    protected $entities;
    protected $conversationRepo;

    public function __construct(array $entities, EntityManager $em) {
        $this->em = $em;
        $this->entities = $entities;
    }

    /**
     * @param      $user
     * @param bool $admin is group admin
     * @param bool $receiveOld the user will receive old messages
     */
    public function addMember($conversation, $user, $admin = false, $receiveOld = true) {

        $userHasConversation = $this->em->getRepository($this->entities['user_has_conversation'])->findOneBy(array('conversation' => $conversation, 'user' => $user));

        if (!$userHasConversation) {
            $userHasConversation = new $this->entities['user_has_conversation']();
            $userHasConversation->setConversation($conversation);
            $userHasConversation->setUser($user);
            $userHasConversation->setIsAdmin($admin);
            $userHasConversation->setJoined(new \DateTime());
            $conversation->addMember($userHasConversation);
        } else {
            if ($userHasConversation->isActive()) {
                $receiveOld = false;
            } else {
                $userHasConversation->setIsAdmin($admin);
            }
        }

        if ($receiveOld) {
            foreach($conversation->getMessages() as $message) {
                $this->sendMessage($message, $user, true);
            }
        }
    }

    /**
     * @param      $message
     * @param      $user
     * @param bool $wasRead
     */
    public function sendMessage($message, $user, $wasRead = false) {

        $userHasMessage = $this->em->getRepository($this->entities['user_has_message'])->findOneBy(array('message' => $message, 'user' => $user));
        if ($userHasMessage == null) {
            $userHasMessage = new $this->entities['user_has_message']();
            $userHasMessage->setWasRead($wasRead);
            $userHasMessage->setUser($user);
            $userHasMessage->setMessage($message);
            $message->addSentTo($user);
        }
    }

    /**
     * @param $conversation
     * @param $user
     */
    public function removeMember($conversation, $user) {
        $userHasConversation = $this->em->getRepository($this->entities['UserHasConversation'])->findOneBy(array('conversation' => $conversation, 'user' => $user));
        if ($userHasConversation != null) {
            $userHasConversation->setLeft(new \DateTime());
            $userHasConversation->setActive(false);
        }
    }
}