<?php

namespace SwitchUserStatelessBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProfileController
{
    /**
     * @var NormalizerInterface
     */
    protected $serializer;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * @param NormalizerInterface           $serializer
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(
        NormalizerInterface $serializer,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker
    ) {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route("/profile")
     * @Method({"GET", "HEAD"})
     *
     * @return Response
     */
    public function profileAction()
    {
        return new JsonResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'json'));
    }

    /**
     * @link http://symfony.com/doc/current/cookbook/security/impersonating_user.html
     *
     * @Route("/profile-impersonating")
     * @Method({"GET", "HEAD"})
     * 
     * @return Response
     */
    public function profileImpersonatingAction()
    {
        if ($this->authorizationChecker->isGranted('ROLE_PREVIOUS_ADMIN')) {
            return new JsonResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'json'));
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
