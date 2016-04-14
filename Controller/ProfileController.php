<?php

namespace SwitchUserStatelessBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/", service="switch_user_stateless.controller.profile")
 */
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
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function profileAction(Request $request)
    {
        return new JsonResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'json'));
    }
}
