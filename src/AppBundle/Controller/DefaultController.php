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

        if (!is_null($request->get('region')) || $request->getMethod() == 'POST') {
            $form->submit($request);
            $pagerfanta = $em->getRepository('AppBundle:Sale')->getSalesByRegion(is_null($form['region']->getData()) ? $request->get('region') : $form['region']->getData());
            $pagerfanta->setCurrentPage($request->get('page', 1));

            return $this->render('salesRequestForm.html.twig', array(
                'form' => $this->createForm(new SalesAddFormType())->createView(),
                'sales' => $pagerfanta,
                'regionDescr' => Sale::$regionDescr
            ));
        }

        return $this->render('salesRequestForm.html.twig', array(
            'form' => $form->createView(),
            'sales' => new Pagerfanta(new ArrayAdapter(array())),
            'regionDescr' => Sale::$regionDescr
        ));
    }

    /**
     * @Route("/sales/list", name="sale_list")
     */
    public function listAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $pagerfanta = $em->getRepository('AppBundle:Sale')->getSales();
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('salesRequestForm.html.twig', array(
            'form' => false,
            'sales' => $pagerfanta,
            'regionDescr' => Sale::$regionDescr
        ));
    }
}
