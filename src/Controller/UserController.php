<?php

namespace App\Controller;

use App\Entity\Users;
use App\Type\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route(path="/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route(path="/create")
     * @param Request $req
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function create(Request $req, EntityManagerInterface $entityManager): Response
    {
        $user = new Users('');
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('userlist');
        }

        return $this->render('user/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @Route(path="/list", name="userlist")
     */
    public function list(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Users::class);
        $users = $repository->findAll();
        return $this->render('user/list.html.twig', ['users' => $users]);
    }

    /**
     * @param int $id
     * @param EntityManagerInterface $entityManager
     * @Route(path="/delete/{id}")
     */
    public function delete(int $id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Users::class);
        $userToDelete = $repository->find($id);
        $entityManager->remove($userToDelete);
        $entityManager->flush();
        return $this->redirectToRoute('userlist');
    }

    /**
     * @param Users $user
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return Response
     * @Route(path="/edit/{id}")
     */
    public function edit(Users $user, EntityManagerInterface $entityManager, Request $request): Response
    {
        if ($request->getMethod() == 'POST') {
            $user->setName($request->get('name', $user->getName()));
            $user->setSurname($request->get('surname', $user->getSurname()));
            $entityManager->flush();
            return $this->redirectToRoute('userlist');
        }

        return $this->render('user/edit.html.twig', ['user' => $user]);
    }
}