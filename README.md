SwitchUserStatelessBundle
-------------------------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lafourchette/SwitchUserStatelessBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lafourchette/SwitchUserStatelessBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/lafourchette/SwitchUserStatelessBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lafourchette/SwitchUserStatelessBundle/?branch=master)
[![Build Status](https://travis-ci.org/lafourchette/SwitchUserStatelessBundle.svg?branch=master)](https://travis-ci.org/lafourchette/SwitchUserStatelessBundle)

This bundle provides impersonating feature (switch user) for API use.

Install this bundle through [Composer](https://getcomposer.org/):

```
composer require lafourchette/switch-user-stateless-bundle
```

Then, update your AppKernel.php file as following:

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new SwitchUserStatelessBundle\SwitchUserStatelessBundle(),
        ];
```

Load routing in `app/config/routing.yml`:

```yml
switch_user_stateless:
    resource: "@SwitchUserStatelessBundle/Controller/ProfileController.php"
    type: annotation
```

Finally, update your firewalls in your `app/config/security.yml` file as following:

```yml
security:
    firewalls:
        main:
            # ...
            stateless: true
            switch_user_stateless: true
```

[Read the complete doc](/Resources/doc/index.md)
