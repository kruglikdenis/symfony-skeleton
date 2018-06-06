<?php

namespace App\DataFixture\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class AbstractFixture extends Fixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @param string $pattern
     * @return array
     */
    protected function getReferencesByPattern(string $pattern)
    {
        $names = array_keys($this->referenceRepository->getReferences());
        $names = array_filter($names, function ($key) use ($pattern) {
            return 0 === strpos($key, $pattern);
        });

        $references = array_combine($names, array_map(function ($name) {
            return $this->getReference($name);
        }, $names));

        ksort($references);

        return $references;
    }
}