<?php
/**
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

namespace EComprocessing\Components\Interfaces;

/**
 * Token protection Interface
 * Used for protecting the Payment pages with Token validation
 *
 * Interface EComprocessingTokenValidation
 * @package EComprocessing\Components\Interfaces
 */
interface EcomprocessingTokenValidation
{
    /**
     * Return all Controller actions with Token protection
     *
     * @return array
     */
    public function getTokenProtectedActions();
}
