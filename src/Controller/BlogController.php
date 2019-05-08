<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-08
	 * Time: 10:46
	 */
	
	namespace App\Controller;
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	
	class BlogController extends AbstractController
	{
		/**
		 * @Route("/blog/show/{slug<[a-z-0-9]+>?article-sans-titre}", name="blog_show")
		 */
		public function show($slug) : Response
		{
			$slug = str_replace('-', ' ', $slug);
			$slug = strval($slug);
			$slug = ucwords($slug);
			return $this->render('blog/show.html.twig', [
				'slug' => $slug
			]);
		}
	}