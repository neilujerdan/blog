<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-08
	 * Time: 10:46
	 */
	
	namespace App\Controller;
	
	use App\Entity\Article;
	use App\Entity\Category;
	use App\Entity\Tag;
	use App\Form\CategoryType;
	use App\Form\ArticleSearchType;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	
	class BlogController extends AbstractController
	{
		/**
		 * Show all row from article's entity
		 *
		 * @Route("/blog/", name="blog_index")
		 * @return Response A response instance
		 */
		public function index(): Response
		{
			
			$articles = $this->getDoctrine()
				->getRepository(Article::class)
				->findAll();
			
			if (!$articles) {
				throw $this->createNotFoundException(
					'No article found in article\'s table.'
				);
			}
			
			return $this->render('blog/index.html.twig', [
						'articles' => $articles,
					]);
		}
		
		/**
		 * Getting a article with a formatted slug for title
		 *
		 * @param string $slug The slugger
		 *
		 * @Route("/blog/show/{slug<^[a-z0-9-]+$>}",
		 *     defaults={"slug" = null},
		 *     name="blog_show")
		 *  @return Response A response instance
		 */
		public function show(string $slug) : Response
		{
			if (!$slug) {
				throw $this
					->createNotFoundException('No slug has been sent to find an article in article\'s table.');
			}
			
			$slug = preg_replace(
				'/-/',
				' ', ucwords(trim(strip_tags($slug)), "-")
			);
			
			$article = $this->getDoctrine()
				->getRepository(Article::class)
				->findOneBy(['title' => mb_strtolower($slug)]);
			
			if (!$article) {
				throw $this->createNotFoundException(
					'No article with '.$slug.' title, found in article\'s table.'
				);
			}
			
			return $this->render(
				'blog/show.html.twig',
				[
					'article' => $article,
					'slug' => $slug,
				]
			);
		}
		
		/**
		 * Getting a article with a formatted slug for title
		 *
		 *
		 * @Route("/blog/category/{name}",
		 *     requirements={"category"="^[a-z0-9-]+$"},
		 *     defaults={"category" = null},
		 *     name="show_Category")
		 *  @return Response A response instance
		 */
		public function showByCategory(Category $category) : Response
		{
			/*
			$category = $this->getDoctrine()
				->getRepository(Category::class)
				->findOneBy(['name' => $category]);
			
			$articles = $this->getDoctrine()
				->getRepository(Article::class)
				->findBy(['category' => $category], array('id' => 'DESC'),3);
			
			if (!$articles) {
				throw $this->createNotFoundException(
					'No article with '.$articles.' title, found in article\'s table.'
				);
			}
			*/
			return $this->render(
				'blog/category.html.twig',
				[
					'category' => $category,
					'articles' => $category->getArticles(),
				]
			);
		}
		
		/**
		 * Getting a article with a formatted slug for title
		 *
		 *
		 * @Route("/blog/tag/{name}",
		 *     defaults={"tag" = null},
		 *     name="show_tag")
		 *  @return Response A response instance
		 */
		public function showByTag(Tag $tag) : Response
		{
			dump($tag->getName());
			return $this->render(
				'blog/tag.html.twig',
				[
					'tagName' => $tag->getName(),
					'articles' => $tag->getArticles(),
				]
			);
		}
	}