<?php
namespace App\Action;

use App\Abstracts\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeAction extends BaseController
{
    public function dispatch(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Home page action dispatched");
        $this->view->render($response, 'home.twig');
        return $response;
    }
}
