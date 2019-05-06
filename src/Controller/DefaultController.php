<?php
	/**
	 * Created by PhpStorm.
	 * User: julien
	 * Date: 2019-05-06
	 * Time: 19:17
	 */
	
	namespace App\Controller;
	
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	
	class DefaultController extends AbstractController
	{
		/**
		 * @Route("/", name="app_index")
		 */
		public function index()
		{
			return $this->render('home/default.html.twig');
		}
	}