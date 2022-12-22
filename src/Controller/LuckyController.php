<?php
// src/Controller/LuckyController.php
namespace App\Controller;

#use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController 
{
    /**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */
    public function number(int $max): Response
    {
        $number = random_int(0, $max);

        return new Response(
            '<html><body>Lucky number: '.$number.'<br>Max number is '.$max.'</body></html>'
        );
        /*return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);*/
    }
}