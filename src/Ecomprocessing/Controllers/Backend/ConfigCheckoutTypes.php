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

use Ecomprocessing\Components\Base\SdkService;
use Ecomprocessing\Components\Services\EcomprocessingConfig;
use Genesis\API\Constants\Transaction\Names;
use \Genesis\API\Constants\Transaction\Types as GenesisTransactionTypes;
use \Genesis\API\Constants\Payment\Methods as GenesisPaymentMethods;

/**
 * Class Shopware_Controllers_Backend_ConfigCheckoutTypes
 */
class Shopware_Controllers_Backend_ConfigCheckoutTypes extends Shopware_Controllers_Backend_ExtJs
{
    /**
     * Endpoint for retrieving the available Checkout transaction types via Ajax
     */
    public function listTypesAction()
    {
        $data = [];

        $transactionTypes = GenesisTransactionTypes::getWPFTransactionTypes();
        $excludedTypes    = SdkService::getRecurringTransactionTypes();

        // Exclude PPRO transaction. This is not standalone transaction type
        array_push($excludedTypes, GenesisTransactionTypes::PPRO);

        // Exclude Google Pay transaction
        array_push($excludedTypes, GenesisTransactionTypes::GOOGLE_PAY);

        // Exclude PayPal transaction
        array_push($excludedTypes, GenesisTransactionTypes::PAY_PAL);

        // Exclude Apple Pay transactions
        array_push($excludedTypes, GenesisTransactionTypes::APPLE_PAY);

        // Exclude Transaction Types
        $transactionTypes = array_diff($transactionTypes, $excludedTypes);

        // Add PPRO types
        $pproTypes = array_map(
            function ($type) {
                return $type . EcomprocessingConfig::PPRO_TRANSACTION_SUFFIX;
            },
            GenesisPaymentMethods::getMethods()
        );

        $googlePayTypes = array_map(
            function ($type) {
                return EcomprocessingConfig::GOOGLE_PAY_TRANSACTION_PREFIX . $type;
            },
            [
                EcomprocessingConfig::GOOGLE_PAY_PAYMENT_TYPE_AUTHORIZE,
                EcomprocessingConfig::GOOGLE_PAY_PAYMENT_TYPE_SALE
            ]
        );

        $payPalTypes = array_map(
            function ($type) {
                return EcomprocessingConfig::PAYPAL_TRANSACTION_PREFIX . $type;
            },
            [
                EcomprocessingConfig::PAYPAL_PAYMENT_TYPE_AUTHORIZE,
                EcomprocessingConfig::PAYPAL_PAYMENT_TYPE_SALE,
                EcomprocessingConfig::PAYPAL_PAYMENT_TYPE_EXPRESS
            ]
        );

        $applePayTypes = array_map(
            function ($type) {
                return EcomprocessingConfig::APPLE_PAY_TRANSACTION_PREFIX . $type;
            },
            [
                EcomprocessingConfig::APPLE_PAY_TYPE_AUTHORIZE,
                EcomprocessingConfig::APPLE_PAY_TYPE_SALE
            ]
        );

        $transactionTypes = array_merge(
            $transactionTypes,
            $pproTypes,
            $googlePayTypes,
            $payPalTypes,
            $applePayTypes
        );
        asort($transactionTypes);

        foreach ($transactionTypes as $type) {
            $name = Names::getName($type);
            if (!GenesisTransactionTypes::isValidTransactionType($type)) {
                $name = strtoupper($type);
            }

            array_push(
                $data,
                [
                    'value' => $type,
                    'option' => $name
                ]
            );
        }

        $this->view->assign(
            [
                'data'  => $data
            ]
        );
    }
}
