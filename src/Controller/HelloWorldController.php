<?php

namespace App\Controller;

use App\Service\LuckyNumber;
use Exception;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
    /**
     * @Route(path="/hello/{name}/{surname}", name="hello")
     * @param string $name
     * @param string $surname
     * @param Request $request
     * @param LoggerInterface $logger
     * @param LuckyNumber $number
     * @return Response
     */
    public function hello(string $name, string $surname, Request $request, LoggerInterface $logger, LuckyNumber $number): Response
    {
        $luckyNumber = $number->getNumber();
        $ppl = ['Kamil Brzozowski', 'Dariusz Opania', 'Adolf Hitler', 'Józef Markoś'];
        return $this->render('hello/hello.html.twig', ['name' => $name, 'surname' => $surname, 'people' => $ppl, 'number' => $luckyNumber]);
    }

    /**
     * @Route(path="/dice", name="dice")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function dice(Request $request): Response
    {
        $randomNumber = random_int(1, 10);
        $number = (int)$request->get('number');
        $result = '';

        if ($number) {
            if ($number == $randomNumber) {
                $result = 'Gratulacje! Trafiles!';
            } else {
                $result = 'Niestety, nie udalo sie...';
            }
        }

        return new Response("<html><body><h1 style='text-align: center'>$randomNumber</h1><h2>$result</h2></body></html>");
    }

    /**
     * @Route(path="/redirect/{action}", requirements={"action"="time|hello|dice"})
     * @param Request $req
     * @param string $action
     * @return RedirectResponse
     * @throws Exception
     */
    public function redirectToPage(string $action, Request $req): RedirectResponse
    {
        $arg = [];
        if ($action == 'hello') {
            $arg = ['name' => 'Jacek', 'surname' => 'Balcerzak'];
        }
        if ($action == 'dice') {
            $arg = ['number' => $req->get('number')];
        }
        return $this->redirectToRoute($action, $arg);
    }

    /**
     * @Route(path="/book/{page<\d+>}/{author}")
     * @param $page
     * @param string $author
     * @return Response
     */
    public function book(int $page = 1, string $author = ""): Response
    {
        $endText = '';
        if ($author) {
            $endText = "written by $author";
        }
        return new Response('Welcome on page ' . $page . ' ' . $endText);
    }

}