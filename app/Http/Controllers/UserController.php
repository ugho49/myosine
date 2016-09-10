<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLogin() {
        return view('backend.login', []);
    }

    public function postLogin(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {

            // success
            Session::flash('flash_message', 'Vous êtes connecté avec succès.');
            Session::flash('flash_type', 'success');

            $user = Auth::user();
            $user->last_ip = $_SERVER["REMOTE_ADDR"];
            $user->save();

            Auth::setUser($user);

            return redirect()->route('admin');
        }

        return redirect()->route('login')
            ->withErrors(Lang::get('auth.failed'))
            ->withInput();
    }

    public function edit(Request $request) {

        $current_user = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->to(route('admin_settings').'?type=info_user#info_user')
                ->withErrors($validator)
                ->withInput();
        }

        // success
        Session::flash('flash_message', 'Les informations sont modifiés avec succès');
        Session::flash('flash_type', 'success');

        $current_user->email = Input::get('email');
        $current_user->name = Input::get('name');
        $current_user->save();

        Auth::setUser($current_user);


        return redirect()->route('admin_settings');
    }

    public function editPassword(Request $request) {
        $current_user = Auth::user();

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:6|different:old_password',
            'password_confirm' => 'min:6|same:password'
        ]);

        if (Auth::attempt(['email' => $current_user->email, 'password' => Input::get('old_password')])) {

            if ($validator->fails()) {
                return redirect()->to(route('admin_settings').'?type=update_password#update_password')
                    ->withErrors($validator)
                    ->withInput();
            }

            // success
            Session::flash('flash_message', 'Le mot de passe à été modifié avec succès');
            Session::flash('flash_type', 'success');

            $current_user->password = bcrypt(Input::get('password'));
            $current_user->save();

            Auth::setUser($current_user);

            return redirect()->route('admin_settings');
        }

        return redirect()->to(route('admin_settings').'?type=update_password#update_password')
            ->withErrors("L'ancien mot de passe ne correspond pas.")
            ->withInput();
    }

    public function logout() {
        Auth::logout();
        Session::flash('flash_message', 'Vous êtes déconnecté avec succès.');
        Session::flash('flash_type', 'info');
        return redirect()->route('login');
    }

    public function resetPassword(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'email|required'
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', "Erreur de format de l'adresse mail");
            Session::flash('flash_type', 'warning');
        } else {
            $user = User::where('email', Input::get('email'))->first();

            if (!$user) {
                Session::flash('flash_message', "Adresse email inconnue");
                Session::flash('flash_type', 'warning');
            } else {
                $randomPassword = $this->generateRandomPassword();
                $user->password = bcrypt($randomPassword);
                $user->save();

                Session::flash('flash_message', "Votre nouveau mot de passe viens de vous être envoyé par mail");
                Session::flash('flash_type', 'info');

                $this->sendMail($user, $randomPassword);
            }
        }

        return redirect()->route('login');
    }

    private function generateRandomPassword() {
        $char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $charLong = "";

        for ($i = 0; $i < 30; $i++) {
            $charLong .= $char;
            $charLong = str_shuffle($charLong);
        }

        $chaineAleatoire = substr($charLong, 0, 20);

        return $chaineAleatoire;
    }

    private function sendMail($user, $newPassword) {
        $mailer = new \PHPMailer();

        //Set who the message is to be sent from
        $mailer->setFrom('no-reply@myosine-club-fitness-angers.fr', 'myosine-club-fitness-angers.fr');
        //Set who the message is to be sent to
        $mailer->addAddress($user->email, $user->name);
        //Set the subject line
        $mailer->Subject = 'Reinitialisation Mot de Passe - MYOSINE';
        // Set email format to HTML
        $mailer->isHTML(true);
        //convert HTML into a basic plain-text alternative body
        $mailer->Body = View::make('mails.reset_password', [
            'newPassword' => $newPassword
        ])->render();
        //Replace the plain text body with one created manually
        $mailer->AltBody = 'Message au format HTML, merci de l\'ouvrir avec un logiciel compatible.';
        //send the message, check for errors
        return $mailer->send();
    }
}
