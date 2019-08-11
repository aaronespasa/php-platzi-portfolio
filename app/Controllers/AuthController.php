<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function getLogin($request) {
        $responseMessage = null;

        return $this->renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

    public function postLogin($request) {


        if (isset($_POST['submit_login'])) {
            if($request->getMethod() == 'POST') {
                $postData = $request->getParsedBody();

                $userValidator = Validator::key('email', Validator::stringType()->notEmpty())
                                 ->key('password', Validator::stringType()->notEmpty());

                try {
                    $userValidator->assert($postData);

                    $user = User::where('email', $postData['email'])->first();
                    if($user) {
                        echo 'email found';
                        if(\password_verify($postData['password'], $user->password)) {
                            $_SESSION['userId'] = $user->id;
                            return new RedirectResponse('/php-platzi-portfolio/public/admin');
                        } else {
                            $responseMessage = 'Bad credentials';
                        }
                    } else {
                        $responseMessage = 'Bad credentials';
                    }
                    
                    return $this->renderHTML('login.twig', [
                        'responseMessage' => $responseMessage
                    ]);

                } catch(\Exception $e) {
                    $responseMessage = $e->getMessage();
                }
            }
        }
    }

    public function getLogout() {
        unset($_SESSION['userId']);
        return new RedirectResponse('/php-platzi-portfolio/public/login');
    }
}