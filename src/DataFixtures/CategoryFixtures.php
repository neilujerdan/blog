<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-21
	 * Time: 10:51
	 */
	
	namespace App\DataFixtures;
	
	use App\Entity\Category;
	use Doctrine\Bundle\FixturesBundle\Fixture;
	use Doctrine\Common\Persistence\ObjectManager;
	
	class CategoryFixtures extends Fixture
	{
		const CATEGORIES = [
			'PHP',
			'JAVA',
			'Javascript',
			'Ruby',
			'DevOps',
		];
		
		public function load(ObjectManager $manager)
		{
			// TODO: Implement load() method.
			foreach (self::CATEGORIES as $key => $categoryName) {
				$category = new Category();
				$category->setName($categoryName);
				$manager->persist($category);
				$this->addReference('categorie_' . $key, $category);
			}
			$manager->flush();
		}
	}