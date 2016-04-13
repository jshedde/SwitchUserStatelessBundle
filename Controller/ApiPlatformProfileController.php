<?php

namespace SwitchUserStatelessBundle\Controller;

use ApiPlatform\Core\JsonLd\Response as JsonLdResponse;
use Dunglas\ApiBundle\Api\ResourceCollectionInterface;
use Dunglas\ApiBundle\Api\ResourceInterface;
use Dunglas\ApiBundle\Exception\InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiPlatformProfileController extends ProfileController
{
    /**
     * @var ResourceCollectionInterface
     */
    private $resourceCollection;

    /**
     * @param NormalizerInterface              $serializer
     * @param TokenStorageInterface            $tokenStorage
     * @param AuthorizationCheckerInterface    $authorizationChecker
     * @param ResourceCollectionInterface|null $resourceCollection
     */
    public function __construct(
        NormalizerInterface $serializer,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        ResourceCollectionInterface $resourceCollection = null
    ) {
        parent::__construct($serializer, $tokenStorage, $authorizationChecker);

        $this->resourceCollection = $resourceCollection;
    }

    /**
     * @Route("/profile")
     * @Method({"GET", "HEAD"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function profileAction(Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        // API Platform 1
        if (null !== $this->resourceCollection) {
            return new Response(
                $this->serializer->normalize(
                    $user,
                    'json-ld',
                    $this->getResource($request)->getNormalizationContext() + [
                        'request_uri' => $request->getRequestUri(),
                    ]
                )
            );
        }

        // API Platform 2
        return new JsonLdResponse(
            $this->serializer->normalize(
                $user,
                'jsonld',
                [
                    'request_uri'         => $request->getRequestUri(),
                    'resource_class'      => get_class($this->tokenStorage->getToken()->getUser()),
                    'item_operation_name' => 'profile',
                ]
            )
        );
    }

    /**
     * @link http://symfony.com/doc/current/cookbook/security/impersonating_user.html
     *
     * @Route("/profile-impersonating")
     * @Method({"GET", "HEAD"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function profileImpersonatingAction(Request $request)
    {
        if ($this->authorizationChecker->isGranted('ROLE_PREVIOUS_ADMIN')) {
            $user = $this->tokenStorage->getToken()->getUser();

            // API Platform 1
            if (null !== $this->resourceCollection) {
                return new Response(
                    $this->serializer->normalize(
                        $user,
                        'json-ld',
                        $this->getResource($request)->getNormalizationContext() + [
                            'request_uri' => $request->getRequestUri(),
                        ]
                    )
                );
            }

            // API Platform 2
            return new JsonLdResponse(
                $this->serializer->normalize(
                    $user,
                    'jsonld',
                    [
                        'request_uri'         => $request->getRequestUri(),
                        'resource_class'      => get_class($this->tokenStorage->getToken()->getUser()),
                        'item_operation_name' => 'profile_impersonating',
                    ]
                )
            );
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @param Request $request
     *
     * @throws InvalidArgumentException
     *
     * @return ResourceInterface
     */
    private function getResource(Request $request)
    {
        if (!$request->attributes->has('_resource')) {
            throw new InvalidArgumentException('The current request doesn\'t have an associated resource.');
        }

        $shortName = $request->attributes->get('_resource');
        if (!($resource = $this->resourceCollection->getResourceForShortName($shortName))) {
            throw new InvalidArgumentException(sprintf('The resource "%s" cannot be found.', $shortName));
        }

        return $resource;
    }
}
