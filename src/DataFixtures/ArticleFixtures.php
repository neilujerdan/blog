<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-21
	 * Time: 11:01
	 */
	
	namespace App\DataFixtures;
	
	use App\Entity\Article;
	use App\service\Slugify;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\Persistence\ObjectManager;
	use Doctrine\Common\DataFixtures\DependentFixtureInterface;
	use Faker;
	
	class ArticleFixtures extends Fixture implements DependentFixtureInterface
	{
		public function getDependencies()
		{
			return [CategoryFixtures::class];
		}
		
		public function load(ObjectManager $manager)
		{
			// TODO: Implement load() method.
			$slugify = new Slugify();
			$faker  =  Faker\Factory::create('fr_FR');
			for ($i = 0; $i < 50; $i++) {
				$article = new Article();
				$article->setTitle(mb_strtolower($faker->sentence()));
				$article->setContent(mb_strtolower($faker->text()));
				$slug = $slugify->generate($article->getTitle());
				$article->setSlug($slug);
				$manager->persist($article);
				$k = rand(0,4);
				for ($j=0; $j<$k; $j++) {
                    $article->addTag($this->getReference('tag_' . rand(0, 8)));
                }
				$article->setCategory($this->getReference('categorie_'. rand(0,4)));
				$this->addReference('article_'. $i, $article);
			}
			$manager->flush();
		}
	}