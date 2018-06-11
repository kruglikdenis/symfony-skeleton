<?php

namespace App\DataFixture\ORM;


use App\Upload\Entity\FileSaver;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadFiles extends AbstractFixture implements OrderedFixtureInterface
{
    const FIXTURES_COUNT = 10;
    /**
     * @var FileSaver
     */
    private $saver;

    public function __construct(FileSaver $saver)
    {
        $this->saver = $saver;

        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        foreach (range(1, self::FIXTURES_COUNT) as $i) {
            $file = new UploadedFile('/app/app/fixtures/files/avatar.png', "{$this->faker->word}.png", 'image/png');
            $reference = $this->saver->save($file);

            $this->setReference("file-{$i}", $reference);
            $manager->persist($reference);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}