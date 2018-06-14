<?php

namespace App\DependencyInjection\CompilePass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class RepositoryCompilePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $em = new Reference('doctrine.orm.entity_manager');

        $repositories = $container->findTaggedServiceIds('app.repository');
        foreach ($repositories as $id => $repository) {
            $definition = $container->getDefinition($id);

            $definition->addMethodCall('construct', [
                $em, $repository[0]['entity']
            ]);
        }
    }
}