SwitchUserStatelessBundle
-------------------------

This bundle provides impersonating feature (switch user) for API use.

1. [Request](#request)
2. [Security](#security)
3. [Who am I](#who-am-i)
4. [Connect with API Platform 2](#connect-with-api-platform-2)

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

In impersonating use, it is still possible to check who is the original user, by calling `/profile-impersonating` uri.

## Connect with API Platform 2

[API Platform](https://api-platform.com/) is a PHP framework to build REST APIs with JSON-LD responses. By default,
this bundle supports standard JSON response. To connect with API Platform 2, you need to replace default routing by
following one:

```yml
switch_user_stateless:
    resource: "@SwitchUserStatelessBundle/Controller/ApiPlatformProfileController"
    type: annotation
```
