<?php
/**
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author      emerchantpay
 * @copyright   Copyright (C) 2015-2023 emerchantpay Ltd.
 * @license     http://opensource.org/licenses/MIT The MIT License
 */

namespace Genesis\API\Traits\Request\Financial;

/**
 * Trait DescriptorAttributes
 *
 * Trait for Transactions with Dynamic Descriptor Params
 *
 * @package Genesis\API\Traits\Request\Financial
 *
 * @method $this setDynamicMerchantName($value) Dynamically override the charge descriptor
 * @method $this setDynamicMerchantCity($value) Dynamically override the merchant phone number
 * @method $this setDynamicSubMerchantId($value) Sub-merchant ID assigned by the Payment Facilitator
 */
trait DescriptorAttributes
{
    /**
     * Allows to dynamically override the charge descriptor
     *
     * @var string
     */
    protected $dynamic_merchant_name;

    /**
     * Allows to dynamically override the mer- chant phone number
     *
     * @var string
     */
    protected $dynamic_merchant_city;

    /**
     * Sub-merchant ID assigned by the Payment Facilitator
     *
     * @var string $dynamic_sub_merchant_id
     */
    protected $dynamic_sub_merchant_id;

    /**
     * Builds an array list with all Params
     *
     * @return array
     */
    protected function getDynamicDescriptorParamsStructure()
    {
        return [
            'merchant_name'   => $this->dynamic_merchant_name,
            'merchant_city'   => $this->dynamic_merchant_city,
            'sub_merchant_id' => $this->dynamic_sub_merchant_id
        ];
    }
}
