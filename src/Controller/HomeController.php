<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-06
	 * Time: 19:17
	 */
	
	namespace App\Controller;
	
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	
	class HomeController extends AbstractController
	{
		/**
		 * @Route("/", name="homepage")
		 */
		public function index() : Response
		{
			return $this->render('home/index.html.twig');
		}
	}