<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrentTime
{
    /**
     * @Route(path="/time", name="time", methods="POST")
     * @return Response
     */
    public function showCurrentDate(): Response
    {
        $currentDate = new \DateTime('now');
        return $this->getResponse('Current date: ', $currentDate);
    }

    /**
     * @Route(path="/time", name="tomorrowTime", methods="GET")
     * @return Response
     */
    public function showTomorrowDate(): Response
    {
        $date = new \DateTime('now');
        $tomorrowDate = $date->add(new \DateInterval('P1D'));
        return $this->getResponse('Tomorrow date: ', $tomorrowDate);
    }

    private function getResponse(string $title, \DateTime $date)
    {
        $date = $date->format(DATE_COOKIE);
        return new Response('<html><body><h1 style="text-align: center">' . $title . '</h1><h2 style="text-align: center">' . $date . '</h2></body></html>');
    }
}