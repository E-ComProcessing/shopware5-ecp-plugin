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

use EComprocessing\Components\Constants\SdkSettingKeys;

/**
 * Class Shopware_Controllers_Backend_EcomprocessingMethodConfigs
 * @SuppressWarnings(PHPMD.CamelCaseClassName)
 */
//@codingStandardsIgnoreStart
class Shopware_Controllers_Backend_EcomprocessingMethodConfigs extends Shopware_Controllers_Backend_ExtJs
//@codingStandardsIgnoreEnd
{
    public function listConfigsAction()
    {
        $data   = [];
        $method = $this->Request()->getParam('method');

        /** @var \EComprocessing\Models\Config\Repository $configMethodsRepo */
        $configMethodsRepo = $this->container->get('models')->getrepository(
            \EComprocessing\Models\Config\Methods::class
        );

        $configs = $configMethodsRepo->getAllByMethod($method);

        if (!$configs) {
            $this->view->assign([
                'data' => $data
            ]);
            return;
        }

        /** @var \EComprocessing\Models\Config\Methods $config */
        foreach ($configs as $config) {
            $data[$config->getOption()] = $config->getOptionValue();
        }

        $this->view->assign(
            [
                'data' => $data
            ]
        );
    }

    public function saveConfigAction()
    {
        try {
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $this->container->get('models');

            foreach ($this->Request()->getParams() as $option => $value) {
                if (!in_array($option, SdkSettingKeys::getAll())) {
                    continue;
                }

                /** @var \EComprocessing\Models\Config\Repository $configsRepository */
                $configsRepository = $this->container->get('models')->getRepository(
                    \EComprocessing\Models\Config\Methods::class
                );

                /** @var \EComprocessing\Models\Config\Methods $optionModel */
                $optionModel = $configsRepository->loadOption($option, $this->Request()->getParam('method'));
                $optionModel->setOptionValue($value);

                $em->persist($optionModel);
                $em->flush();
            }

            $this->view->assign(
                [
                    'success' => true
                ]
            );
        } catch (\Exception $e) {
            $this->view->assign(
                [
                    'success' => false,
                    'message' => substr($e->getMessage(), 0, 255)
                ]
            );
        }
    }
}
