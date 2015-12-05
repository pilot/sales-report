<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Form\Type\SalesAddFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/sales/add", name="sale_add")
     */
    public function indexAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $sale = new Sale();

        if ($request->getMethod() == 'POST') {
            $form = $this->createForm(new SalesAddFormType(), $sale);
            $form->submit($request);
            if ($form->isValid()) {
                $em->persist($sale);
                $em->flush();

                return $this->render('salesAddForm.html.twig', array(
                    'form' => $this->createForm(new SalesAddFormType())->createView(),
                    'success' => true,
                ));
            } else {
                return $this->render('salesAddForm.html.twig', array(
                    'form' => $form->createView(),
                    'success' => false,
                ));
            }
        }

        return $this->render('salesAddForm.html.twig', array(
            'form' => $this->createForm(new SalesAddFormType())->createView(),
            'success' => true,
        ));
    }
}
