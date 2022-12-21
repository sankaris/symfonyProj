<?php
namespace App\Controller;

#use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController
{
   public function message():Response
   {
      return new Response("<html><body><i>Hello World!</i></body></html>");
   }
}
