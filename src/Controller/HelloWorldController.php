<?php
namespace App\Controller;

use App\Service\MessageGenerator;
use App\Service\SuffixGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloWorldController extends AbstractController
{
   protected $messageGenerator;
   protected $suffixGenerator;
   public function __construct(MessageGenerator $messageGenerator,SuffixGenerator $suffixGenerator){
        $this->messageGenerator = $messageGenerator;
        $this->suffixGeneartor = $suffixGenerator;
        //$this->addFlash('success', $message);
        //return new Response($message);
    }
   /**
    * @Route("/helloworld/message/{fname}",name="message")
    */
   public function message(string $fname): Response {
      return new Response("<html><body><i>Hello ".$fname."!</i></body></html>");
   }

   /**
    * @Route("/helloworld/msg",name="greet")
    */
    public function msg(MessageGenerator $messageGenerator): Response {
      $message = $messageGenerator->getHappyMessage();
      $this->addFlash('success', $message);
      return new Response($message);
    }

    /**
     * @Route("helloworld/display/{num}",name="display")
     */
    public function display(SuffixGenerator $suffixGenerator,int $num): Response {
      $suffix = $suffixGenerator->getSuffix($num);
      return new Response(json_encode($suffix));
    }
}
