<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Service\RPNHelper;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/", name="app_calculator")
     */
    public function index(): Response
    {
        return $this->render('calculator/index.html.twig');
    }

    /**
     * @Route("/api/compute", name="compute")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function compute(RPNHelper $RPNHelper): JsonResponse
    {
        $request = Request::createFromGlobals();
        $operation = $request->query->get('operation');
        $result = $RPNHelper->compute($operation);

        $response = new JsonResponse(
            [
                'result' => $result,
            ]
        );
  
        return $response;
    }
}