<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundleIndexer\Model\ResourceModel\Indexer;

class ExecuteListByChildrenIds
{
    /**
     * @var ReindexBySourceItemIds
     */
    private $reindexBySourceItemIds;

    /**
     * @var GetChildrenSourceItemsIdsByChildrenProductIds
     */
    private $getChildrenSourceItemsIdsByChildrenProductIds;

    /**
     * @param ReindexBySourceItemIds $reindexBySourceItemIds
     * @param GetChildrenSourceItemsIdsByChildrenProductIds $getChildrenSourceItemsIdsByChildrenProductIds
     */
    public function __construct(
        ReindexBySourceItemIds $reindexBySourceItemIds,
        GetChildrenSourceItemsIdsByChildrenProductIds $getChildrenSourceItemsIdsByChildrenProductIds
    ) {
        $this->reindexBySourceItemIds = $reindexBySourceItemIds;
        $this->getChildrenSourceItemsIdsByChildrenProductIds = $getChildrenSourceItemsIdsByChildrenProductIds;
    }

    /**
     * @param array $productIds
     * @param string $bundleSku
     * @return void
     */
    public function execute(array $productIds, $bundleSku)
    {
        $bundleChildrenSourceItemsIds = $this->getChildrenSourceItemsIdsByChildrenProductIds->execute($productIds);
        $bundleChildrenSourceItemsIdsWithSku = [
            $bundleSku => $bundleChildrenSourceItemsIds
        ];
        $this->reindexBySourceItemIds->execute($bundleChildrenSourceItemsIdsWithSku);
    }
}
