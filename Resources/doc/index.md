SwitchUserStatelessBundle
-------------------------

This bundle provides impersonating feature (switch user) for API use.

1. [Request](#request)
2. [Security](#security)
3. [Who am I](#who-am-i)

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
