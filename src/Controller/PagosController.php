<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use MercadoPago\MP, Preference, SDK, Payment;
class PagosController extends AbstractController
{
    
    /**
     * @Route("/pagos.html", name="pagos")
     */
    public function pagos(): Response
    {
        return $this->render('pagos/pagos.html.twig', []);
    }
    public function realizarPreaprobacion(): Response
    {
        $url = 'https://api.mercadopago.com/preapproval';
        $accessToken = ''; // Reemplaza con tu token de acceso

        $data = [
            "preapproval_plan_id" => "2c938084726fca480172750000000000",
            "reason" => "Yoga classes",
            "external_reference" => "YG-1234",
            "payer_email" => "test_user@testuser.com",
            "card_token_id" => "e3ed6f098462036dd2cbabe314b9de2a",
            "auto_recurring" => [
                "frequency" => 1,
                "frequency_type" => "months",
                "start_date" => "2020-06-02T13:07:14.260Z",
                "end_date" => "2022-07-20T15:59:52.581Z",
                "transaction_amount" => 5000,
                "currency_id" => "ARS"
            ],
            "back_url" => "https://www.mercadopago.com.ar",
            "status" => "authorized"
        ];

        $dataString = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);

        return new Response($response);
    }
    public function createPreference(): Response
    {
       
    }
    /**
     * @Route("/confirmar-pago", name="confirmar_pago")
     */
    public function confirmarPago(Request $request, string $id): Response
    {                                                           //hacer integracion APIREST
        // URL de la API de Mercado Pago
        $url = 'https://api.mercadopago.com/v1/tu-endpoint-aqui'; // Reemplaza con la URL correcta de la API de Mercado Pago
        
        // Configura los encabezados de la solicitud con tu token de acceso
        $headers = [
            'Authorization: Bearer ', // Reemplaza con tu token de acceso
        ];

        // Realiza la solicitud GET a la API de Mercado Pago
        $response = file_get_contents($url, false, stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", $headers),
            ],
        ]));

        // Procesa la respuesta como desees
        // Puedes devolver la respuesta como una respuesta HTTP o realizar otras acciones

        return new Response($response);
    }
    //     return $this->render('pagos/confirmar_pago.html.twig', []);
    // }

}

