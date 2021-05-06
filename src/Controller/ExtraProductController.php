<?php

namespace App\Controller;

use App\Entity\ExtraProduct;
use App\Entity\Restaurant;
use App\Form\ExtraProductType;
use App\Repository\ExtraProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/extra-product")
 */
class ExtraProductController extends AbstractController
{
    /**
     * @Route("/{name}", name="extra_product_index", methods={"GET"})
     */
    public function index(Restaurant $restaurant, ExtraProductRepository $extraProductRepository): Response
    {
        return $this->render('extra_product/index.html.twig', [
            'extra_products' => $extraProductRepository->findAll(),
            'restaurant' => $restaurant
        ]);
    }

    /**
     * @Route("/new", name="extra_product_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $extraProduct = new ExtraProduct();
        $form = $this->createForm(ExtraProductType::class, $extraProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($extraProduct);
            $entityManager->flush();

            return $this->redirectToRoute('extra_product_index');
        }

        return $this->render('extra_product/new.html.twig', [
            'extra_product' => $extraProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="extra_product_show", methods={"GET"})
     */
    public function show(ExtraProduct $extraProduct): Response
    {
        return $this->render('extra_product/show.html.twig', [
            'extra_product' => $extraProduct,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="extra_product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ExtraProduct $extraProduct): Response
    {
        $user = $this->getUser();
        $restaurantOwners = $user->getRestaurants()->getValues();
//        dd($restaurantOwners);
        $restaurantOwnersIds = [];
//        foreach($restaurantOwners as $restaurantOwner) {
//            $restaurantOwnersIds[] = $restaurantOwner->getId();
//        }
//        if(in_array($user->getId(), $restaurantOwnersIds)) {
        if($restaurantOwners != [] || $restaurantOwners != null) {
            //        dd($user->getRestaurants()->getValues()[0]->getUser()->getValues());
            $form = $this->createForm(ExtraProductType::class, $extraProduct);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('extra_product_index');
            }

            return $this->render('extra_product/edit.html.twig', [
                'extra_product' => $extraProduct,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }

    /**
     * @Route("/{id}", name="extra_product_delete", methods={"POST"})
     */
    public function delete(Request $request, ExtraProduct $extraProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$extraProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($extraProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('extra_product_index');
    }
}
