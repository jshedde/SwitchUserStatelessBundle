<?php

namespace SwitchUserStatelessBundle\Tests\UserBundle\Security;

use SwitchUserStatelessBundle\Tests\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    /**
     * @var array|User[]
     */
    private $users = [
        'admin' => [
            'id' => 42,
            'email' => 'admin@example.com',
            'firstName' => 'Admin',
            'lastName' => 'ADMIN',
            'password' => 'admin',
            'roles' => ['ROLE_ALLOWED_TO_SWITCH'],
        ],
        'john.doe' => [
            'id' => 54,
            'email' => 'john.doe@example.com',
            'firstName' => 'John',
            'lastName' => 'DOE',
            'password' => 'john.doe',
            'roles' => ['ROLE_USER'],
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        if (!isset($this->users[$username])) {
            throw new UsernameNotFoundException();
        }

        $user = new User();
        $user->setId($this->users[$username]['id']);
        $user->setEmail($this->users[$username]['email']);
        $user->setFirstName($this->users[$username]['firstName']);
        $user->setLastName($this->users[$username]['lastName']);
        $user->setUsername($username);
        $user->setPassword($this->users[$username]['password']);
        $user->setRoles($this->users[$username]['roles']);

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
