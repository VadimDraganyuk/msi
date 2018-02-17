<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundleIndexer\Plugin\Indexer\SourceItem;

use Magento\InventoryBundleIndexer\Model\ResourceModel\Indexer\ExecuteFullBySourceItems;
use Magento\InventoryBundleIndexer\Model\ResourceModel\Indexer\ExecuteListBySourceItems;

class AddBundleChildrenDataToIndex
{
    /**
     * @var ExecuteListBySourceItems
     */
    private $executeList;

    /**
     * @var ExecuteFullBySourceItems
     */
    private $executeFull;

    /**
     * @param ExecuteListBySourceItems $executeList
     * @param ExecuteFullBySourceItems $executeFull
     */
    public function __construct(
        ExecuteListBySourceItems $executeList,
        ExecuteFullBySourceItems $executeFull
    ) {
        $this->executeList = $executeList;
        $this->executeFull = $executeFull;
    }

    /**
     * @param \Magento\InventoryIndexer\Indexer\SourceItem\SourceItemIndexer $sourceItemIndexer
     * @param $result
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterExecuteFull(
        \Magento\InventoryIndexer\Indexer\SourceItem\SourceItemIndexer $sourceItemIndexer,
        $result
    ) {
        $this->executeFull->execute();
    }

    /**
     * @param \Magento\InventoryIndexer\Indexer\SourceItem\SourceItemIndexer $subject
     * @param $result
     * @param array $sourceItemIds
     *
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterExecuteList(
        \Magento\InventoryIndexer\Indexer\SourceItem\SourceItemIndexer $subject,
        $result,
        array $sourceItemIds
    ) {
        $this->executeList->execute($sourceItemIds);
    }
}
