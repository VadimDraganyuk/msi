<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundleIndexer\Model\ResourceModel\Indexer;

use Magento\Framework\App\ResourceConnection;
use Magento\Inventory\Model\ResourceModel\SourceItem;

class GetChildrenSourceItemsIdsByChildrenProductIds
{
    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        ResourceConnection $resourceConnection
    ) {
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @param array $productIds
     * @return array
     */
    public function execute(array $productIds): array
    {
        $select = $this->resourceConnection->getConnection()->select();
        $select->from(
            ['source_item' => $this->resourceConnection->getTableName(SourceItem::TABLE_NAME_SOURCE_ITEM)],
            [SourceItem::ID_FIELD_NAME]
        )->joinInner(
            ['product' => $this->resourceConnection->getTableName('catalog_product_entity')],
            'source_item.sku = product.sku',
            []
        )->where(
            'product.entity_id in (?)',
            $productIds
        );

        $sourceItemIds = $select->query()->fetchAll();

        $sourceItemIds = array_map(
            function($sourceItem) {
              return  $sourceItem[SourceItem::ID_FIELD_NAME];
            },
            $sourceItemIds
        );

        return $sourceItemIds;
    }
}
