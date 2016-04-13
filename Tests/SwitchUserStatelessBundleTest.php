<?php

namespace SwitchUserStatelessBundle\Tests;

use Prophecy\Prophecy\ObjectProphecy;
use SwitchUserStatelessBundle\DependencyInjection\Security\SwitchUserStatelessFactory;
use SwitchUserStatelessBundle\SwitchUserStatelessBundle;

class SwitchUserStatelessBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $bundle = new SwitchUserStatelessBundle();

        $extension = $this->getSecurityExtensionMock();
        $extension->addSecurityListenerFactory(new SwitchUserStatelessFactory())->shouldBeCalled();

        $container = $this->getContainerBuilderMock();
        $container->getExtension('security')->willReturn($extension)->shouldBeCalled();

        $bundle->build($container->reveal());
    }

    /**
     * @return ObjectProphecy
     */
    private function getContainerBuilderMock()
    {
        return $this->prophesize('Symfony\Component\DependencyInjection\ContainerBuilder');
    }

    /**
     * @return ObjectProphecy
     */
    private function getSecurityExtensionMock()
    {
        return $this->prophesize('Symfony\Bundle\SecurityBundle\DependencyInjection\SecurityExtension');
    }
}
