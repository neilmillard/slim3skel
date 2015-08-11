<?php
namespace App\Action;

use App\Abstracts\BaseController;
use RedBeanPHP\R;
use Slim\Http\Request;
use Slim\Http\Response;

final class UserAction extends BaseController
{
    public function dispatch(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Users page action dispatched");
        $data = [];
        $users = R::findAll( 'users' );

        $this->view->render($response, 'users.twig',['users'=> $users]);
        return $response;
    }

    public function deleteUser(Request $request, Response $response, Array $args)
    {
        $name = $args['name'];
        if(empty($name)){
            $this->flash->addMessage('flash','No user specified');
            return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('users'));
        }
        $user = R::findOne('users', ' name = ? ',[ $name ]);
        if(!empty($user)){
            R::trash($user);
            $this->flash->addMessage('flash',"$name deleted");
        } else {
            $this->flash->addMessage('flash',"$name User not found");
        }
        return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('users'));
    }
}
