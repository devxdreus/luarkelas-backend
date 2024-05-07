<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Mailtrap\Config;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class EmailController extends Controller
{
    public function index()
    {
        try {
            $apiKey = env('MAILTRAP_API_KEY');
            $mailtrap = new MailtrapClient(new Config($apiKey));

            $email = (new Email())
                ->from(new Address('admin@luarkelas.id', 'Luarkelas Indonesia'))
                ->to(new Address("firman.fp123@gmail.com"))
                ->subject("Monthly Report Learning")
                ->text('
                Salam Hormat kak, Firman Perdana
                Laporan belajar baru telah terbit, silahkan diperiksa dengan akun yang telah terdaftar di luarkelas.id

                Hormat Kami,
                Tim Luarkelas Indonesia
                '
                )
            ;

            // $email->getHeaders()
            //     ->add(new CategoryHeader('Integration Test'))
            // ;

            $response = $mailtrap->sending()->emails()->send($email);

            var_dump(ResponseHelper::toArray($response));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
