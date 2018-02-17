<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\InventoryBundleIndexer\Plugin\Indexer\SourceItem;

use Magento\Bundle\Api\Data\OptionInterface;
use Magento\Bundle\Api\ProductOptionRepositoryInterface;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\InventoryBundleIndexer\Model\ResourceModel\Indexer\ExecuteListByChildrenIds;

class AddBundleDataToIndex
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ExecuteListByChildrenIds
     */
    private $executeListByChildrenIds;

    /**
     * @param ProductRepository $productRepository
     * @param ExecuteListByChildrenIds $executeListByChildrenIds
     */
    public function __construct(
        ProductRepository $productRepository,
        ExecuteListByChildrenIds $executeListByChildrenIds
    ) {
        $this->productRepository = $productRepository;
        $this->executeListByChildrenIds = $executeListByChildrenIds;
    }

    /**
     * @param ProductOptionRepositoryInterface $subject
     * @param $result
     * @param ProductInterface $product
     * @param OptionInterface $option
     *
     * @return int
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterSave(
        ProductOptionRepositoryInterface $subject,
        $result,
        ProductInterface $product,
        OptionInterface $option
    ) {
        $productLinks = $option->getProductLinks();

        $productIds = [];
        foreach ($productLinks as $productLink) {
            $productId = $productLink->getProductId();
            if (null === $productId) {
                $productId = $this->productRepository->get($productLink->getSku())->getId();
            }
            $productIds[] = $productId;
        }

        $this->executeListByChildrenIds->execute($productIds, $product->getSku());

        return $result;
    }
}
