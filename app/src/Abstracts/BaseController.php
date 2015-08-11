<?php

namespace App\Abstracts;

use Authenticator\Authenticator;
use Slim\Flash\Messages;
use Slim\Router;
use Slim\Views\Twig;
use Monolog\Logger;

abstract class BaseController
{
    protected $view;
    protected $logger;
    protected $router;
    protected $flash;
    protected $authenticator;

    public function __construct(Twig $view, Logger $logger, Router $router, Messages $flash,Authenticator $authenticator)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->router = $router;
        $this->flash = $flash;
        $this->authenticator = $authenticator;
    }

}