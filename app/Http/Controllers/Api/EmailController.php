<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Mailtrap\Config;
use Mailtrap\EmailHeader\CategoryHeader;
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
                ->from(new Address('mailtrap@demomailtrap.com', 'Mailtrap Test'))
                ->to(new Address("firman.fp123@gmail.com"))
                ->subject('You are awesome!')
                ->text('Congrats for sending test email with Mailtrap!')
            ;

            $email->getHeaders()
                ->add(new CategoryHeader('Integration Test'))
            ;

            $response = $mailtrap->sending()->emails()->send($email);

            var_dump(ResponseHelper::toArray($response));
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}