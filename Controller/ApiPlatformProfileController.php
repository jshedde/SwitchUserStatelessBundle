<?php

namespace SwitchUserStatelessBundle\Controller;

use ApiPlatform\Core\JsonLd\Response as JsonLdResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiPlatformProfileController extends ProfileController
{
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
        $context = [
            'request_uri'         => $request->getRequestUri(),
            'resource_class'      => get_class($this->tokenStorage->getToken()->getUser()),
            'item_operation_name' => 'profile',
        ];

        return new JsonLdResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'jsonld', $context));
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
            $context = [
                'request_uri'         => $request->getRequestUri(),
                'resource_class'      => get_class($this->tokenStorage->getToken()->getUser()),
                'item_operation_name' => 'profile_impersonating',
            ];

            return new JsonLdResponse($this->serializer->normalize($this->tokenStorage->getToken()->getUser(), 'jsonld', $context));
        }

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
