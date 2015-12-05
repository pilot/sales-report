<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Form\Type\SalesAddFormType;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/sales/add", name="sale_add")
     */
    public function addAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        if ($request->getMethod() == 'POST') {
            $sale = new Sale();
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

    /**
     * @Route("/sales/request", name="sale_request")
     */
    public function requestAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $form = $this->createForm(new SalesAddFormType());

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            $pagerfanta = new Pagerfanta(new ArrayAdapter($em->getRepository('AppBundle:Sale')->findBy(array(
                'region' => $form['region']->getData(),
                'hasTransportDelivery' => true
            ))));
            $pagerfanta->setMaxPerPage(20);
            $pagerfanta->setCurrentPage($request->get('page', 1));
            if (!is_null($form['region']->getData())) {
                return $this->render('salesRequestForm.html.twig', array(
                    'form' => $this->createForm(new SalesAddFormType())->createView(),
                    'sales' => $pagerfanta,
                    'regionDescr' => Sale::$regionDescr
                ));
            }
        }
        $pagerfanta = new Pagerfanta(new ArrayAdapter($em->getRepository('AppBundle:Sale')->findAll()));
        $pagerfanta->setMaxPerPage(20);
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('salesRequestForm.html.twig', array(
            'form' => $form->createView(),
            'sales' => $pagerfanta,
            'regionDescr' => Sale::$regionDescr
        ));
    }
}
