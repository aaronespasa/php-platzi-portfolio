<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator;

class UsersController extends BaseController {
    public function getAddUserAction($request) {

        $responseMessage = null;

        if (isset($_POST['submit_user'])) {
            if($request->getMethod() == 'POST') {
                $postData = $request->getParsedBody();

                $userValidator = Validator::key('email', Validator::stringType()->notEmpty())
                                 ->key('password', Validator::stringType()->notEmpty());

                try {
                    $userValidator->assert($postData);

                    $user = new User();
                    $user->email = $postData['email'];

                    $hashed_password = password_hash($postData['password'], PASSWORD_DEFAULT);
                    $user->password = $hashed_password;
                    $user->save();

                    $responseMessage = 'You have successfully signed up to this page!';

                } catch(\Exception $e) {
                    $responseMessage = $e->getMessage();
                }
            }
        }
        return $this->renderHTML('addUser.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}