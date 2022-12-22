<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LayoutController extends AbstractController
{
    /**
     * @Route("/layout", name="layout")
     */
    public function index()
    {
        $name = "Anu";
        $age = 10;
        $words = ['sky', 'blue', 'cloud', 'symfony', 'forest'];
        $msg = "hello , good day !";
        $dob = "10/10/2010";
        return $this->render('layout/index.html.twig',[
            'words' => $words,
            'msg' => $msg,
            'name' => $name,
            'age' => $age,
            'dob' => $dob
        ]);
    }
}
