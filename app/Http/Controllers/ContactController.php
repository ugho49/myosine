<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function index() {
        $adresse = "MYOSINE, 19 rue Faidherbe, 49000 ANGERS";
        return view('frontend.contact', ["adresse" => $adresse]);
    }

    public function postMessage(Request $request) {

        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'email' => 'email|required',
            'message' => 'required|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->to(route('contact').'#contact')
                ->withErrors($validator)
                ->withInput();
        }

        if (!$this->verifyRecaptcha($request->input('g-recaptcha-response'))) {
            return redirect()->to(route('contact').'#contact')
                ->withErrors(Lang::get('validation.recaptcha'))
                ->withInput();
        }

        $this->sendMail($request);

        // success
        Session::flash('flash_message', 'Message envoyé avec succès.');
        Session::flash('flash_type', 'success');
        return redirect()->route('contact');
    }

    private function verifyRecaptcha($recaptcha_response) {

        if (empty($recaptcha_response)) {
            return false; // Si aucune reponse n'est entré, on ne cherche pas plus loin
        }

        $params = [
            'secret'    => env('RECAPTCHA_SECRET'),
            'response'  => $recaptcha_response
        ];

        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if (function_exists('curl_version')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Evite les problèmes, si le ser
            $response = curl_exec($curl);

        } else {
            // Si curl n'est pas dispo, un bon vieux file_get_contents
            $response = file_get_contents($url);
        }

        if (empty($response) || is_null($response)) {
            return false;
        }

        $json = json_decode($response);
        return $json->success;
    }

    private function sendMail() {
        $mailer = new \PHPMailer();

        $information = Session::get('informations');

        //Set who the message is to be sent from
        $mailer->setFrom('no-reply@myosine-club-fitness-angers.fr', 'myosine-club-fitness-angers.fr');
        //Set who the message is to be sent to
        $mailer->addAddress($information->mail_salle, 'Myosine');
        //Set the subject line
        $mailer->Subject = 'Message Contact - MYOSINE';
        // Set email format to HTML
        $mailer->isHTML(true);
        //convert HTML into a basic plain-text alternative body
        $mailer->Body = View::make('mails.contact', [
            'name' => Input::get('nom'),
            'email' => Input::get('email'),
            'message' => Input::get('message')
        ])->render();
        //Replace the plain text body with one created manually
        $mailer->AltBody = 'Message au format HTML, merci de l\'ouvrir avec un logiciel compatible.';
        //send the message, check for errors
        return $mailer->send();
    }
}
