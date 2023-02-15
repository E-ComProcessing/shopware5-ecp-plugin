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

namespace Ecomprocessing\Components\Services;

use Genesis\API\Constants\Transaction\States;
use Genesis\Genesis;
use Shopware\Components\Model\ModelManager;
use Shopware\Models\Customer\Customer;

/**
 * Class WpfTokenizationService
 */
class WpfTokenizationService
{
    /**
     * @var EcomprocessingLogger
     */
    private $pluginLogger;

    /**
     * @var ModelManager
     */
    private $modelManager;

    public function __construct(ModelManager $modelManager, EcomprocessingLogger $pluginLogger)
    {
        $this->modelManager = $modelManager;
        $this->pluginLogger = $pluginLogger;
    }

    /**
     * @param $email
     *
     * @return string|null
     */
    public function retrieveConsumerIdFromEmail($email, $method)
    {
        $response = null;
        try {
            $genesis = new Genesis('NonFinancial\Consumers\Retrieve');
            $genesis->request()->setEmail($email);
            $genesis->execute();

            $response = $genesis->response()->getResponseObject();

            if (!$this->isConsumerEnabled($response)) {
                throw new \Exception("Consumer is not enabled");
            }

            return $response->consumer_id;
        } catch (\Exception $exception) {
            $this->pluginLogger->debug(
                sprintf(
                    "Error retrieving consumer_id for %s from API. Error is: %s",
                    $email,
                    $exception->getMessage()
                ),
                $method,
                (array) $response
            );

            return null;
        }
    }

    /**
     * @param $customerId

     * @return Customer|null
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function findCustomerById($customerId)
    {
        return $this->modelManager->find(Customer::class, $customerId);
    }

    /**
     * @param string $customerId
     * @param string $consumerId
     *
     * @return void
     */
    public function saveConsumerIdToDb($customerId, $consumerId)
    {
        $customer = $this->findCustomerById($customerId);

        if ($customer) {
            $customer->getAttribute()->setEcpTokenConsumerId($consumerId);
            $this->modelManager->persist($customer);
            $this->modelManager->flush();
        }
    }

    /**
     * @param $shopwareUserId
     * @param $email
     *
     * @return string|null
     */
    public function getConsumerId($shopwareUserId, $email, $method)
    {
        $customer   = $this->findCustomerById($shopwareUserId);
        $consumerId = $customer->getAttribute()->getEcpTokenConsumerId();

        if (!$consumerId) {
            $consumerId = $this->retrieveConsumerIdFromEmail($email, $method);
        }

        return $consumerId;
    }

    /**
     * @param $response
     *
     * @return bool
     */
    private function isConsumerEnabled($response)
    {
        $state = new States($response->status);

        return $state->isEnabled();
    }
}
