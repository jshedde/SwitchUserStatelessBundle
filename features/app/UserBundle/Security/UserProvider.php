<?php

namespace SwitchUserStatelessBundle\Tests\UserBundle\Security;

use SwitchUserStatelessBundle\Tests\UserBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $user = new User();
        $user->setId(42);
        $user->setEmail('admin@example.com');
        $user->setFirstName('Admin');
        $user->setLastName('ADMIN');
        $user->setUsername('admin');
        $user->setPassword('admin');

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return 'SwitchUserStatelessBundle\Tests\UserBundle\Entity\User' === $class;
    }
}
