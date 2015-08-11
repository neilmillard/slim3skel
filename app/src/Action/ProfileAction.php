<?php
namespace App\Action;

use App\Abstracts\BaseController;
use RedBeanPHP\R;
use Slim\Http\Request;
use Slim\Http\Response;

final class ProfileAction extends BaseController
{
    public function dispatch(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Profile page action dispatched");

        //grab identity id.
        $id=$this->authenticator->getIdentity();
        $user = R::findOne('users',' name = :username ',['username'=>$id['name']]);
        $this->view->render($response, 'profile.twig',$user->export());
        return $response;
    }

    public function editUser(Request $request, Response $response, Array $args)
    {
        $username = strtolower($args['username']);
        if(empty($username)){
            $this->flash->addMessage('flash','No user specified');
            return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('profile'));
        }
        $id=$this->authenticator->getIdentity();
        // restrict access to own profile or Admin user
        if($username!=strtolower($id['name'])){
            if(strtolower($id['name'])!='admin'){
                $this->flash->addMessage('flash','Access Denied');
                return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('profile'));
            }
        }
        if($username!='new'){
            $user = R::findOrCreate('users', [
                'name' => $username
            ]);
        } else {
            $user = R::dispense('users');
        }
        if ($request->isPost()) {
            $data = $request->getParams();
            //$username = $request->getParam('username');
            $user->import($data,'fullname,colour,mobile,home');
            $user->name = $request->getParam('username');
            $password = $request->getParam('password');
            if(!empty($password)){
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $user->hash = $pass;
            }

            $id = R::store($user);
            $this->flash->addMessage('flash',"$user->name updated");
            return $response->withRedirect($request->getUri()->getBaseUrl().$this->router->pathFor('edituser',['username'=>$username]));
        }
        $this->view->render($response, 'user.twig',$user->export());
        return $response;

    }
}
