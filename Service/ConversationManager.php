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
        $userHasConversation = $conversation != null ?$this->em->getRepository($this->entities['user_has_conversation'])->findOneBy(array('conversation' => $conversation, 'user' => $user)) : null;

        $welcomeMsg = $conversation->getId() != null;

        if (!$userHasConversation) {
            //user was not persisted, but we may added him in this session
            foreach($conversation->getMembers() as $member) {
                if ($member->getUser() == $user) {
                    $userHasConversation = $member;
                    break;
                }
            }
        }
        if (!$userHasConversation) {
            $userHasConversation = new $this->entities['user_has_conversation']();
            $userHasConversation->setConversation($conversation);
            $userHasConversation->setUser($user);
            $userHasConversation->setIsAdmin($admin);
            $userHasConversation->setJoinedOn(new \DateTime());
            $conversation->addMember($userHasConversation);
        } else {
            if ($userHasConversation->isActive()) {
                $welcomeMsg = false;
                $receiveOld = false;
            } else {
                $userHasConversation->setIsAdmin($admin);
                $userHasConversation->setLeftOn(null);
                $userHasConversation->setActive(true);
            }
        }

        if ($receiveOld) {
            foreach($conversation->getMessages() as $message) {
                $this->sendMessage($message, $user, true);
            }
        }

        if ($welcomeMsg) {
            $msg = new $this->entities['message']();
            $msg->setText($user . ' joined the conversation.');
            $this->sendToConversation($conversation, $msg);
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
            $message->addSendTo($userHasMessage);
        }
    }

    /**
     * @param $conversation
     * @param $user
     */
    public function removeMember($conversation, $user, $goodByeMsg = true) {
        $userHasConversation = $this->em->getRepository($this->entities['UserHasConversation'])->findOneBy(array('conversation' => $conversation, 'user' => $user));



        if ($userHasConversation != null && $userHasConversation->isActive()) {

            if ($goodByeMsg) {
                $msg = new $this->entities['message']();
                $msg->setText($user . ' left the conversation.');
                $this->sendToConversation($conversation, $msg);
            }

            $userHasConversation->setLeftOn(new \DateTime());
            $userHasConversation->setActive(false);
        }
    }

    /**
     * @param $conversation
     * @param $message
     */
    public function sendToConversation($conversation, $message) {
        $conversation->addMessage($message);
        foreach($conversation->getMembers() as $member) {
            if ($member->isActive()) {
                $this->sendMessage($message, $member->getUser());
            }
        }
    }
}