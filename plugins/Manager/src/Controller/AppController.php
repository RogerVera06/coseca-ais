<?php

declare(strict_types=1);

namespace Manager\Controller;

use App\Controller\AppController as BaseController;
use System\Controller\Traits\RedirectTrait;

class AppController extends BaseController
{
    use RedirectTrait;

    /**
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');
        $this->loadComponent('CakeLte.MenuLte');
        $this->viewBuilder()->setLayout('CakeLte.default');
        $this->viewBuilder()->setTheme('Manager');
    }
}
