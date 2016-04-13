<?php

namespace SwitchUserStatelessBundle\Controller;

use ApiPlatform\Core\JsonLd\Response as JsonLdResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ProfileController
{
    /**
     * @var NormalizerInterface
     */
    private $serializer;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var string
     */
    private $userClass;

    /**
     * @param NormalizerInterface           $serializer
     * @param TokenStorageInterface         $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param string                        $userClass
     */
    public function __construct(
        NormalizerInterface $serializer,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        $userClass
    ) {
        $this->serializer = $serializer;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
        $this->userClass = $userClass;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function profileAction(Request $request)
    {
        $context = [
            'request_uri'         => $request->getRequestUri(),
            'resource_class'      => $this->userClass,
            'item_operation_name' => 'profile',
        ];

        return new JsonLdResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'jsonld', $context));
    }

    /**
     * @link http://symfony.com/doc/current/cookbook/security/impersonating_user.html
     *
     * @param Request $request
     *
     * @return Response
     */
    public function profileImpersonatingAction(Request $request)
    {
        if ($this->authorizationChecker->isGranted('ROLE_PREVIOUS_ADMIN')) {
            $context = [
                'request_uri'         => $request->getRequestUri(),
                'resource_class'      => $this->userClass,
                'item_operation_name' => 'profile_impersonating',
            ];

            return new JsonLdResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'jsonld', $context));
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
