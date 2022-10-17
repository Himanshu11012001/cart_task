<?php
namespace Task\Second\Block\Adminhtml\Product\Attribute\Edit\Tab;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;

class CustomTab extends \Magento\Backend\Block\Widget\Form\Generic {

    protected $_adminSession;

    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        
        parent::__construct($context, $registry, $formFactory, $data);

    }

    /**
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm() {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $attributeObject = $this->getAttributeObject();

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Please Select Your Page')]);

      // $scopes = [
        //  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE => __('Order Page'),
        //   \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE => __('Cart Page'),
           //\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL => __('Order Page'),
       //];

       $scopes = [
        'Order Page', 'Cart Page'
     ];

    

        
        if ($attributeObject->getAttributeCode() == 'status' || $attributeObject->getAttributeCode() == 'tax_class_id'
      ) {
            unset($scopes[\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE]);
       }

       $fieldset->addField(
            'is_global',
            'select',
            [
                'name' => 'is_global',
              
               'label' => __('Select Page'),
               'title' => __('Select Page'),
                'note' => __('Please Select Page.'),
                'values' => $scopes,
            ],
           'attribute_code'
        );














        $this->setForm($form);

        return parent::_prepareForm();

    }

    public function getTabLabel() {
        return __('Tab Information');
    }

    public function getTabTitle() {
        return __('Tab Information');
    }

    public function canShowTab() {
        return true;
    }

    public function isHidden() {
        return false;
    }
    private function getAttributeObject()
    {
        return $this->_coreRegistry->registry('entity_attribute');
    }

    protected function _isAllowedAction($resourceId) {
        return $this->_authorization->isAllowed($resourceId);
    }
}





































