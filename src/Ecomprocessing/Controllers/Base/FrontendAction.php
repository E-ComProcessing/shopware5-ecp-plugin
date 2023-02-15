<?php
/*
 * Copyright (C) 2021 E-Comprocessing Ltd.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @author      E-Comprocessing
 * @copyright   2021 E-Comprocessing Ltd.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2 (GPL-2.0)
 */

namespace Ecomprocessing\Controllers\Base;

use Enlight_Controller_Action;
use Shopware\Components\Plugin;

class FrontendAction extends Enlight_Controller_Action
{
    /**
     * @var Plugin $plugin
     */
    protected $plugin;

    public function preDispatch()
    {
        $this->plugin = $this->get('kernel')->getPlugins()['Ecomprocessing'];

        $this->get('template')->addTemplateDir($this->plugin->getPath() . '/Resources/views/');
    }
}
