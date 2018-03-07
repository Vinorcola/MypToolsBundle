<?php

namespace Myp\ToolsBundle\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class Authenticator extends AbstractGuardAuthenticator
{
    public function supports(Request $request)
    {
        return (
            $request->server->has('USERINFO_email') &&
            $request->server->has('USERINFO_email_verified') &&
            $request->server->has('USERINFO_given_name') &&
            $request->server->has('USERINFO_family_name') &&
            $request->server->has('USERINFO_name') &&
            $request->server->has('USERINFO_o')
        );
    }

    public function getCredentials(Request $request)
    {
        $roles = $request->server->has('USERINFO_role') ?
            explode(',', $request->server->get('USERINFO_role')) :
            [ 'ROLE_USER' ];

        return [
            'emailAddress'         => $request->server->get('USERINFO_email'),
            'emailAddressVerified' => boolval($request->server->get('USERINFO_email_verified')),
            'firstName'            => $request->server->get('USERINFO_given_name'),
            'lastName'             => $request->server->get('USERINFO_family_name'),
            'displayName'          => $request->server->get('USERINFO_name'),
            'siren'                => $request->server->get('USERINFO_o'),
            'roles'                => $roles,
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
