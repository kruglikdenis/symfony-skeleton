<?php

namespace App\DataFixture\ORM;


use App\Post\Entity\Post;
use App\Post\Entity\TagExtractor;
use App\User\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPosts extends AbstractFixture implements OrderedFixtureInterface
{
    const FIXTURES_COUNT = 10;

    /**
     * @var TagExtractor
     */
    private $extractor;

    public function __construct(TagExtractor $extractor)
    {
        $this->extractor = $extractor;

        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadPosts($manager);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadPosts(ObjectManager $manager)
    {
        /** @var User $user */
        $user = $this->getReference('user-0');
        foreach (range(1, self::FIXTURES_COUNT) as $i) {
            $post = Post::builder()
                ->setAuthor($user->id())
                ->setDescription($this->faker->text(), $this->extractor)
                ->build();

            $this->setReference("post-{$i}", $post);
            $manager->persist($post);
        }
    }

    public function getOrder()
    {
        return 3;
    }
}