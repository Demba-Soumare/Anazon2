<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories', methods:['GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/list.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/{id<^\d+$>}/show', name: 'app_categories_show')]
    public function show(Category $category): Response
    {
        return $this->render('category/category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/category/add', name: 'app_categories_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->persist($form->getData());
                $em->flush();
    
                $this->addFlash('success', 'La catégorie a bien été enregistrée.');
    
                return $this->redirectToRoute('app_categories');
            } else {
                $this->addFlash('warning', 'Problème donnée.');
            }
        }

        return $this->render('category/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/category/{id<^\d+$>}/edit', name: 'app_categories_edit')]
    public function edit(Request $request, EntityManagerInterface $em, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em->flush();
    
                $this->addFlash('success', 'La catégorie a bien été modifiée.');
    
                return $this->redirectToRoute('app_categories');
            } else {
                $this->addFlash('warning', 'Problème donnée.');
            }
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }
}