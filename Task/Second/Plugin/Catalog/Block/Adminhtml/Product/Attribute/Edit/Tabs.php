<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */


namespace Task\Second\Plugin\Catalog\Block\Adminhtml\Product\Attribute\Edit;

use Magento\Catalog\Block\Adminhtml\Product\Attribute\Edit\Tabs as AttributeEditTabs;

class Tabs
{
    /**
     * @param AttributeEditTabs $subject
     * @return array
     */
    public function beforeToHtml(AttributeEditTabs $subject)
    {
        $content = $subject->getChildHtml('customtab');
        $subject->addTabAfter(
            'vendor_module_tab',
            [
                'label' => __('Page'),
                'title' => __('Page'),
                'content' => $content,
            ],
            'front'
        );

        return [];
    }
}