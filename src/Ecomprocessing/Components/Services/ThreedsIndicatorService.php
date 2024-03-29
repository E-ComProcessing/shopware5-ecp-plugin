<?php
/**
 * Copyright (C) 2018 E-Comprocessing Ltd.
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
 * @copyright   2020 E-Comprocessing Ltd.
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2 (GPL-2.0)
 */

namespace Ecomprocessing\Components\Services;

use Genesis\API\Constants\Transaction\Parameters\Threeds\V2\CardHolderAccount\PasswordChangeIndicators;
use Genesis\API\Constants\Transaction\Parameters\Threeds\V2\CardHolderAccount\RegistrationIndicators;
use Genesis\API\Constants\Transaction\Parameters\Threeds\V2\CardHolderAccount\ShippingAddressUsageIndicators;
use Genesis\API\Constants\Transaction\Parameters\Threeds\V2\CardHolderAccount\UpdateIndicators;
use Genesis\API\Constants\Transaction\Parameters\Threeds\V2\MerchantRisk\ReorderItemIndicators;

/**
 * Class ThreedsIndicatorService
 *
 * Helper service for fetching the 3DSv2 Indicator values
 *
 * @package Ecomprocessing\Components\Services
 */
class ThreedsIndicatorService
{

    /**
     * 3DSv2 date format
     */
    const THREEDS_DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * Indicator value constants
     */
    const CURRENT_TRANSACTION_INDICATOR       = 'current_transaction';
    const LESS_THAN_30_DAYS_INDICATOR         = 'less_than_30_days';
    const MORE_THAN_30_LESS_THAN_60_INDICATOR = 'more_30_less_60_days';
    const MORE_THAN_60_DAYS_INDICATOR         = 'more_than_60_days';

    /**
     * Fetch 3DSv2 Account Holder Password Change Indicator
     *
     * @param $passwordChangeDate
     *
     * @return string
     * @throws \Exception
     */
    public function fetchPasswordChangeIndicator($passwordChangeDate)
    {
        return empty($passwordChangeDate)
            ? PasswordChangeIndicators::NO_CHANGE
            : $this->getIndicatorValue($passwordChangeDate, PasswordChangeIndicators::class);
    }

    /**
     * Fetch 3DSv2 Account Holder Update Indicator
     *
     * @param $customerChangeDate
     *
     * @return mixed|string
     * @throws \Exception
     */
    public function fetchUpdateIndicator($customerChangeDate)
    {
        return empty($customerChangeDate)
            ? UpdateIndicators::CURRENT_TRANSACTION
            : $this->getIndicatorValue($customerChangeDate, UpdateIndicators::class);
    }

    /**
     * Fetch whether product/s have been previously re-ordered
     *
     * @param $orderItems
     * @param $profileBoughtItems
     *
     * @return string
     */
    public function fetchReorderItemsIndicator($orderItems, $profileBoughtItems)
    {
        foreach ($orderItems as $product) {
            if (in_array($product['ordernumber'], $profileBoughtItems)) {
                return ReorderItemIndicators::REORDERED;
            }
        }

        return ReorderItemIndicators::FIRST_TIME;
    }

    /**
     * Fetch 3DSv2 Shipping Usage Indicator
     *
     * @param $date
     *
     * @return mixed
     * @throws \Exception
     */
    public function fetchShippingAddressUsageIndicator($date)
    {
        return ($date === null)
            ? null
            : $this->getIndicatorValue($date, ShippingAddressUsageIndicators::class);
    }

    /**
     * Fetch 3DSv2 Registration Indicator
     *
     * @param $firstOrderCreatedAt
     *
     * @return string
     * @throws \Exception
     */
    public function fetchRegistrationIndicator($firstOrderCreatedAt)
    {
        return ($firstOrderCreatedAt === null)
            ? null
            : $this->getIndicatorValue($firstOrderCreatedAt, RegistrationIndicators::class);
    }

    /**
     * Common Indicator method
     *
     * @param $date
     *
     * @return string
     * @throws \Exception
     */
    private function getDateIndicator($date)
    {
        $now       = new \DateTime();
        $checkDate = \DateTime::createFromFormat(self::THREEDS_DATE_FORMAT, $date);
        $days      = $checkDate->diff($now)->days;

        if ($days < 1) {
            return self::CURRENT_TRANSACTION_INDICATOR;
        }
        if ($days <= 30) {
            return self::LESS_THAN_30_DAYS_INDICATOR;
        }
        if ($days < 60) {
            return self::MORE_THAN_30_LESS_THAN_60_INDICATOR;
        }

        return self::MORE_THAN_60_DAYS_INDICATOR;
    }

    /**
     * Get indicator value according the given period of time
     *
     * @param string $date
     * @param string $indicatorClass
     *
     * @return string
     * @throws \Exception
     */
    private function getIndicatorValue($date, $indicatorClass)
    {
        switch (self::getDateIndicator($date)) {
            case static::LESS_THAN_30_DAYS_INDICATOR:
                return $indicatorClass::LESS_THAN_30DAYS;
            case static::MORE_THAN_30_LESS_THAN_60_INDICATOR:
                return $indicatorClass::FROM_30_TO_60_DAYS;
            case static::MORE_THAN_60_DAYS_INDICATOR:
                return $indicatorClass::MORE_THAN_60DAYS;
            default:
                if ($indicatorClass === PasswordChangeIndicators::class) {
                    return $indicatorClass::DURING_TRANSACTION;
                }

                return $indicatorClass::CURRENT_TRANSACTION;
        }
    }
}
