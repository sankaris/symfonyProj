<?php

namespace App\Controller;

use App\Entity\Sample;
use App\Form\SampleType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SampleFormController extends AbstractController
{
    /**
     * @Route("sampleform/show",name="sampleform")
     */
    public function show(Request $request):Response
    {
        $sampleform = new Sample();
        $form = $this->createFormBuilder($sampleform)
               ->add('name',TextType::class)
               ->add('password',PasswordType::class)
               ->add('show',SubmitType::class,['label'=>'Show'])
               ->getForm();
        $form = $this->createForm(SampleType::class,$sampleform);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $name = $form->get('name')->getData();
            $password = $form->get('password')->getData();
            return $this->render('sampleForm/view.html.twig',[
                'name' => $name,
                'password' => $password
            ]);
        }
        return $this->renderForm('sampleForm/index.html.twig',[
            'form' => $form
        ]);
    }
}