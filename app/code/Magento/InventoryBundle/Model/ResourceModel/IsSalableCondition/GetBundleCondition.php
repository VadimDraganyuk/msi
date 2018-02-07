<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundle\Model\ResourceModel\IsSalableCondition;

use Magento\Framework\DB\Select;
use Magento\Inventory\Model\ResourceModel\IsSalableCondition\GetIsSalableConditionInterface;

/**
 * //todo https://github.com/magento-engcom/msi/issues/479
 * Condition for bundle products.
 */
class GetBundleCondition implements GetIsSalableConditionInterface
{
    /**
     * @inheritdoc
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute(Select $select): string
    {
        $condition = 'product_entity.type_id = \'bundle\'';

        return $condition;
    }
}
