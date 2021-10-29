<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class StatusController
{
    /**
     * @Route("/status", methods={"POST"})
     */
    public function status(Request $request,string $situation = "Reprovado!!!"): Response
    {
        $notas = (array) json_decode($request->getContent());

        $n1 = $notas["notas"][0];
        $n2 = $notas["notas"][1];
        $n3 = $notas["notas"][2];

        $avg = ($n1 + $n2 + $n3) / 3;

        if ($avg > 6) {
            $situation = "Aprovado!!!";
        }

        $status = [
            "avg" => $avg,
            "situation" => $situation
        ];

        $response = new Response(json_encode($status));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}