<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Users;
use App\Type\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route(path="/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list", name="categorieslist")
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('category/list.html.twig', ['categories' => $categories]);
    }

    /**
     * @param Request $req
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/create")
     */
    public function create(Request $req, EntityManagerInterface $entityManager): Response
    {
        $category = new Category('');
        $form = $this->createForm(CategoryType::class, $category);


        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('categorieslist');
        }

        return $this->render('category/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @return RedirectResponse
     * @Route(path="/delete/{id}")
     */
    public function delete(int $id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Category::class);
        $categoryToDelete = $repository->find($id);
        $entityManager->remove($categoryToDelete);
        $entityManager->flush();
        return $this->redirectToRoute('categorieslist');
    }
}