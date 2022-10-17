<?php


namespace Task\Second\Block;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductInterfaceFactory;
use Magento\Catalog\Model\Product;
use Magento\Checkout\Block\Cart\Additional\Info as AdditionalBlockInfo;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template as ViewTemplate;
use Magento\Framework\View\Element\Template\Context;


class CartItemBaseUomBlock extends ViewTemplate

{
    /**
     * Product
     *
     * @var ProductInterface|null
     */
    protected $product = null;

    /**
     * Product Factory
     *
     * @var ProductInterfaceFactory
     */
    protected $productFactory;

    /**
     * CartItemBrandBlock constructor
     *
     * @param Context $context
     * @param ProductInterfaceFactory $productFactory
     */
    public function __construct(
        Context $context,
        ProductInterfaceFactory $productFactory
    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }

    /**
     * Get Product Brand Text
     *
     * @return string
     */
    public function getProductBaseUom(): string
    {
        $product = $this->getProduct();

        $sku = $product->getSku();
      

        /** @var Product $product */
      //  $productBaseUom = (string) $product->getData('base_uom');

       // return $productBaseUom;

       return $sku;
    }

    /**
     * Get product from quote item
     *
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        if ($this->product instanceof ProductInterface) {

            return $this->product;
        }

        try {
            $layout = $this->getLayout();
        } catch (LocalizedException $e) {
            $this->product = $this->productFactory->create();

            return $this->product;
        }

        /** @var AdditionalBlockInfo $block */
        $block = $layout->getBlock('additional.product.info');

        if ($block instanceof AdditionalBlockInfo) {
            $item = $block->getItem();
            $this->product = $item->getProduct();
        }

        return $this->product;
    }
    
}