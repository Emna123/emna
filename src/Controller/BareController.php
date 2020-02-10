<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BareController extends AbstractController
{
    /**
     *@route("/bare",name="bare")
     * @return Response
     */




    public function index():Response
    {
        return $this->render('pages/layout.html.twig');
    }
}