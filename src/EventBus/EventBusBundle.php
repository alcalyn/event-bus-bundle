<?php

namespace EventBus;

use EventBus\CommandBus\CommandBusCompilerPass;
use EventBus\DependencyInjection\EventBusExtension;
use EventBus\QueryBus\QueryBusCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EventBusBundle extends Bundle
{
    /**
     * @var string
     */
    private $configurationAlias;

    /**
     * EventBusBundle constructor.
     * @param string $alias
     */
    public function __construct($alias = 'event.bus')
    {
        $this->configurationAlias = $alias;
    }

    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandBusCompilerPass());
        $container->addCompilerPass(new QueryBusCompilerPass());
    }

    public function getContainerExtension()
    {
        return new EventBusExtension($this->configurationAlias);
    }


}
