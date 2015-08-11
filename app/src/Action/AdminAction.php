<?php
namespace App\Action;

use App\Abstracts\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

final class AdminAction extends BaseController
{
    public function dispatch(Request $request, Response $response, Array $args)
    {
        $this->logger->info("Profile page action dispatched");

        $this->view->render($response, 'admin.twig');
        return $response;
    }

}
