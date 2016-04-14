SwitchUserStatelessBundle
-------------------------

This bundle provides impersonating feature (switch user) for API use.

1. [Request](#request)
2. [Security](#security)
3. [Who am I](#who-am-i)
4. [Connect with API Platform](#connect-with-api-platform)

## Request

To use this feature, you need to add a `X-Switch-User` header in your request, with the username of the user you want
to switch:

```
X-Switch-User: johndoe
```

## Security

For security reasons, this feature is only accessible for users with `ROLE_ALLOWED_TO_SWITCH` permission. Admin users
have this permission by default.

## Who am I

This bundle provides you an API method GET `/profile` to get current user profile. In impersonating use, it will return
the impersonated user profile.

## Connect with API Platform

[API Platform](https://api-platform.com/) is a PHP framework to build REST APIs with JSON-LD responses. By default,
this bundle supports standard JSON response. To connect with API Platform, you need to replace default routing by
following one:

```yml
switch_user_stateless:
    resource: "@SwitchUserStatelessBundle/Controller/ApiPlatformProfileController"
    type: annotation
```
