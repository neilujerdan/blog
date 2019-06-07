<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $author = new User();
        $author->setEmail('author@monsite.com');
        $author->setRoles(['ROLE_AUTHOR']);
        $k = rand(5,15);
        for ($j=0; $j<$k; $j++) {
            $author->addArticle($this->getReference('article_' . rand(0, 49)));
        }
        $author->setPassword($this->passwordEncoder->encodePassword(
            $author,
            'author'
        ));

        $manager->persist($author);

        $author = new User();
        $author->setEmail('basthor@monsite.com');
        $author->setRoles(['ROLE_AUTHOR']);
        $k = rand(5,15);
        for ($j=0; $j<$k; $j++) {
            $author->addArticle($this->getReference('article_' . rand(0, 49)));
        }
        $author->setPassword($this->passwordEncoder->encodePassword(
            $author,
            'basthor'
        ));

        $manager->persist($author);

        $admin = new User();
        $admin->setEmail('admmin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'admin'
        ));

        $manager->persist($admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [ArticleFixtures::class];
    }
}
