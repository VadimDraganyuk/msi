<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryCatalog\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\InventoryCatalog\Setup\Operation\AssignDefaultSourceToDefaultStock;
use Magento\InventoryCatalog\Setup\Operation\CreateDefaultSource;
use Magento\InventoryCatalog\Setup\Operation\CreateDefaultStock;
use Magento\InventoryCatalog\Setup\Operation\ReindexDefaultStock;
use Magento\InventoryCatalog\Setup\Operation\UpdateInventorySourceItem;

/**
 * Install Default Source, Stock and link them together
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var CreateDefaultSource
     */
    private $createDefaultSource;

    /**
     * @var CreateDefaultStock
     */
    private $createDefaultStock;

    /**
     * @var AssignDefaultSourceToDefaultStock
     */
    private $assignDefaultSourceToDefaultStock;

    /**
     * @var UpdateInventorySourceItem
     */
    private $updateInventorySourceItem;

    /**
     * @var ReindexDefaultStock
     */
    private $reindexDefaultStock;

    /**
     * @param CreateDefaultSource $createDefaultSource
     * @param CreateDefaultStock $createDefaultStock
     * @param AssignDefaultSourceToDefaultStock $assignDefaultSourceToDefaultStock
     * @param UpdateInventorySourceItem $updateInventorySourceItem
     * @param ReindexDefaultStock $reindexDefaultStock
     */
    public function __construct(
        CreateDefaultSource $createDefaultSource,
        CreateDefaultStock $createDefaultStock,
        AssignDefaultSourceToDefaultStock $assignDefaultSourceToDefaultStock,
        UpdateInventorySourceItem $updateInventorySourceItem,
        ReindexDefaultStock $reindexDefaultStock
    ) {
        $this->createDefaultSource = $createDefaultSource;
        $this->createDefaultStock = $createDefaultStock;
        $this->assignDefaultSourceToDefaultStock = $assignDefaultSourceToDefaultStock;
        $this->updateInventorySourceItem = $updateInventorySourceItem;
        $this->reindexDefaultStock = $reindexDefaultStock;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->createDefaultSource->execute();
        $this->createDefaultStock->execute();
        $this->assignDefaultSourceToDefaultStock->execute();
        $this->updateInventorySourceItem->execute($setup);
        $this->reindexDefaultStock->execute();
    }
}
