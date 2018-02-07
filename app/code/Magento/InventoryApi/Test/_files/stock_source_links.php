<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

use Magento\InventoryApi\Api\Data\StockSourceLinkInterface;
use Magento\InventoryApi\Api\Data\StockSourceLinkInterfaceFactory;
use Magento\InventoryApi\Api\StockSourceLinksSaveInterface;
use Magento\TestFramework\Helper\Bootstrap;

/** @var StockSourceLinksSaveInterface $stockSourceLinksSave */
$stockSourceLinksSave = Bootstrap::getObjectManager()->get(StockSourceLinksSaveInterface::class);
/** @var StockSourceLinkInterfaceFactory $stockSourceLinkFactory */
$stockSourceLinkFactory = Bootstrap::getObjectManager()->get(StockSourceLinkInterfaceFactory::class);

/**
 * EU-source-1(code:eu-1) - EU-stock(id:10)
 * EU-source-2(code:eu-2) - EU-stock(id:10)
 * EU-source-3(code:eu-3) - EU-stock(id:10)
 * EU-source-disabled(code:eu-disabled) - EU-stock(id:10)
 *
 * US-source-1(code:us-1) - US-stock(id:20)
 *
 * EU-source-1(code:eu-1) - Global-stock(id:30)
 * EU-source-2(code:eu-2) - Global-stock(id:30)
 * EU-source-2(code:eu-2) - Global-stock(id:30)
 * EU-source-disabled(code:eu-disabled) - Global-stock(id:30)
 * US-source-1(code:us-1) - Global-stock(id:30)
 */

/**
 * $stock ID => list of source codes
 */
$linksData = [
    10 => ['eu-1', 'eu-2', 'eu-3', 'eu-disabled'],
    20 => ['us-1'],
    30 => ['eu-1', 'eu-2', 'eu-3', 'eu-disabled', 'us-1']
];



$links = [];
$priority = 0;
foreach ($linksData as $stockId => $sourceCodes) {
    foreach ($sourceCodes as $sourceCode) {
        /** @var StockSourceLinkInterface $link */
        $link = $stockSourceLinkFactory->create();

        $link->setStockId($stockId);
        $link->setSourceCode($sourceCode);
        $link->setPriority(++$priority);

        $links[] = $link;
    }
}

$stockSourceLinksSave->execute($links);
