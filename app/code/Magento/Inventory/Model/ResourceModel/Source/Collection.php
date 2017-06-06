<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Inventory\Model\ResourceModel\Source;

use Magento\Inventory\Model\ResourceModel\Source as ResourceSource;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Inventory\Model\Source as SourceModel;

class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(SourceModel::class, ResourceSource::class);
    }
}