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

use Genesis\Utils\Currency as GenesisCurrencyHelper;

/**
 * Class Shopware_Controllers_Backend_EcomprocessingTransactions
 * @SuppressWarnings(PHPMD.CamelCaseClassName)
 */
//@codingStandardsIgnoreStart
class Shopware_Controllers_Backend_EcomprocessingTransactions extends Shopware_Controllers_Backend_ExtJs
//@codingStandardsIgnoreEnd
{
    public function listAction()
    {
        /** @var Ecomprocessing\Models\Transaction\Repository $transactionRepository */
        $transactionRepository = $this->container->get('models')->getRepository(
            Ecomprocessing\Models\Transaction\Transaction::class
        );

        $transactions = $transactionRepository->loadAllByOrder($this->Request()->getParam('orderId'));

        $data = [];
        /** @var Ecomprocessing\Models\Transaction\Transaction $transaction */
        foreach ($transactions as $transaction) {
            $fields = [];

            $fields['id']             = $transaction->getId();
            $fields['transaction_id'] = $transaction->getTransactionId();
            $fields['unique_id']      = $transaction->getUniqueId();
            $fields['payment_token']  = $transaction->getPaymentToken();
            $fields['order_id']       = $transaction->getOrderId();
            $fields['type']           = $transaction->getTransactionType();
            $fields['mode']           = $transaction->getMode();
            $fields['status']         = $transaction->getStatus();
            $fields['amount']         = GenesisCurrencyHelper::exponentToAmount(
                $transaction->getAmount(),
                $transaction->getCurrency()
            );
            $fields['currency']       = $transaction->getCurrency();
            $fields['message']        = $transaction->getMessage();
            $fields['created_at']     = $transaction->getCreatedAt();
            $fields['updated_at']     = $transaction->getUpdatedAt();

            array_push($data, $fields);
        }

        $this->view->assign(
            [
                'data'  => $data,
                'total' => count($transactions)
            ]
        );
    }
}
