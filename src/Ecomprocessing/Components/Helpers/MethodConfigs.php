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

namespace Ecomprocessing\Components\Helpers;

/**
 * Initial Configuration values for the Methods settings
 *
 * Class MethodConfigs
 * @package Ecomprocessing\Components\Helpers
 */
class MethodConfigs
{
    /**
     * Initial Checkout Method Config data settings
     *
     * @return array
     */
    public static function getConfigCheckoutData()
    {
        return [
            [
                'options'      => 'test_mode',
                'optionValues' => 'yes',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'username',
                'optionValues' => null,
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'password',
                'optionValues' => null,
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'transaction_types',
                'optionValues' => serialize([
                    0 => 'authorize',
                    1 => 'sale',
                    2 => 'authorize3d',
                    3 => 'sale3d'
                ]),
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'bank_codes',
                'optionValues' => serialize(''),
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'checkout_language',
                'optionValues' => 'en',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'wpf_tokenization',
                'optionValues' => 'no',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'threeds_option',
                'optionValues' => 'yes',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'challenge_indicator',
                'optionValues' => 'no_preference',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'sca_exemption_option',
                'optionValues' => 'low_risk',
                'methods'      => 'checkout'
            ],
            [
                'options'      => 'sca_exemption_amount',
                'optionValues' => 100,
                'methods'      => 'checkout'
            ]
        ];
    }
}
