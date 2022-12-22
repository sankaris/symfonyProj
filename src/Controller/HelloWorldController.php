<?php
namespace App\Controller;

#use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{
   /**
    * @Route("/helloworld/message/{fname}",name="message")
    */
   public function message(string $fname):Response
   {
      return new Response("<html><body><i>Hello ".$fname."!</i></body></html>");
   }
}
