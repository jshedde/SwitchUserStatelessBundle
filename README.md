SwitchUserStatelessBundle
-------------------------

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

Finally, load routing in `app/config/routing.yml`:

```yml
switch_user_stateless:
    resource: "@SwitchUserStatelessBundle/Resources/config/routing.yml"
```

[Read the complete doc](/Resources/doc/index.md)
