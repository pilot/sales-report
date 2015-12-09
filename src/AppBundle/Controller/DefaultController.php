<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sale;
use AppBundle\Entity\SaleRequest;
use AppBundle\Form\Type\SalesAddFormType;
use AppBundle\Form\Type\SalesRequestFormType;
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
                $sale->setSaleDate(new \DateTime($sale->getSaleDate()));
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
        $saleRequest = new SaleRequest();
        $form = $this->createForm(new SalesRequestFormType(), $saleRequest, ['method' => 'GET']);

        $form->handleRequest($request);
        if ($form->isValid()) {
            if (is_null($request->get('page'))) {
                $em->persist($saleRequest);
                $em->flush();
            }

            $pagerfanta = $em->getRepository('AppBundle:Sale')->getSalesByRegion(is_null($form['region']->getData()) ? $request->get('region') : $form['region']->getData());
            $pagerfanta->setCurrentPage($request->get('page', 1));

            return $this->render('salesRequestForm.html.twig', array(
                'form' => $form->createView(),
                'sales' => $pagerfanta,
                'regionDescr' => Sale::$regionDescr
            ));
        }

        return $this->render('salesRequestForm.html.twig', array(
            'form' => $form->createView(),
            'sales' => new Pagerfanta(new ArrayAdapter(array())),
            'regionDescr' => Sale::$regionDescr,
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

    /**
     * @Route("/sales/request/list", name="sale_requests_list")
     */
    public function requestsListAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $pagerfanta = new Pagerfanta(new ArrayAdapter($em->getRepository('AppBundle:SaleRequest')->findBy(array(), array('createdAt' => 'DESC'))));
        $pagerfanta->setCurrentPage($request->get('page', 1));

        return $this->render('requestsList.html.twig', array(
            'requests' => $pagerfanta,
            'regionDescr' => Sale::$regionDescr
        ));
    }
}
