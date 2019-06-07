<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    const TAGS = [
        'developpement',
        'gueguerre PHP JS',
        'écologie',
        'frameworks',
        'language',
        'projet',
        'table',
        'manchot',
        'grenoble'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::TAGS as $key => $tagName) {
            $tag = new Tag();
            $tag->setName($tagName);
            $manager->persist($tag);
            $this->addReference('tag_' . $key, $tag);
        }

        $manager->flush();
    }
}
