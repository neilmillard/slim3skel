<?php
namespace App\Action;

use App\Abstracts\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class LoginAction extends BaseController
{
    public function login(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Login page action dispatched");
        $username = null;
        $error = null;

        $urlRedirect = $request->getUri()->getBaseUrl().$this->router->pathFor('homepage');

        if (isset($_SESSION['urlRedirect'])) {
            $urlRedirect = $_SESSION['urlRedirect'];
            unset($_SESSION['urlRedirect']);
        }

        if ($request->isPost()) {
            $username = $request->getParam('username');
            $password = $request->getParam('password');

            $result = $this->authenticator->authenticate($username, $password);

            if ($result->isValid()){
                return $response->withRedirect($urlRedirect);
            } else {
                $messages = $result->getMessages();
                $error=(string) $messages[0];
                //$this->flash->addMessage('flash', $error);

            }
        }
        $this->view->render($response, 'login.twig',['username'=> $username,
                                                     'error'=> $error]);
        return $response;
    }

    public function logout(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Logout request action");
        $this->authenticator->clearIdentity();
        return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('homepage'));
    }
}
