SwitchUserStatelessBundle
-------------------------

This bundle provides impersonating feature (switch user) for API use.

## Installation

Install this bundle using [Composer](https://getcomposer.org/):

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
    resource: "@SwitchUserStatelessBundle/Resources/config/routing.yml"
```

Finally, configure this bundle in `app/config/config.yml` file:

```yml
switch_user_stateless:
    user_class: UserBundle\Entity\User
```

[Read the complete doc](/Resources/doc/index.md)
