<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-15
	 * Time: 09:30
	 */
	
	namespace App\Controller;
	
	use App\Entity\Category;
	use App\Form\CategoryType;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	
	class CategoryController extends AbstractController
	{
		
		/**
		 * Show all row from article's entity
		 *
		 * @Route("/category/", name="category_add")
		 * @return Response A response instance
		 */
		public function add(Request $request): Response
		{
			
			$entityManager = $this->getDoctrine()->getManager();
			
			$category = new Category();
			$form = $this->createForm(CategoryType::class, $category);
			$form->handleRequest($request);
			
			
			if ($form->isSubmitted() && $form->isValid()) {
				$entityManager->persist($category);
				$entityManager->flush();
			}
			
			return $this->render('admin/form.html.twig', [
				'form' => $form->createView(),
			]);
		}
		
	}