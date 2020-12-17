<?php
namespace Betelgeuse\Blog\Model\Config\Backend;

use Magento\Framework\App\Config\Value;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;
use Magento\Framework\Model\Context;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;

/**
 * Class Allow
 *
 * @package Betelgeuse\Blog\Model\Config\Backend
 */
class Allow extends Value {

    /**
     * @var Json|null
     */
    private $serializer;

    public
    function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $config,
        TypeListInterface $cacheTypeList,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = [],
        SerializerInterface $serializer
    ) {
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);

        $this->serializer = $serializer;
    }

    /**
     * @return void
     */
    protected
    function _afterLoad() {
        $value = $this->getValue();

        if (!is_array($value)) {
            $this->setValue(empty($value) ? false : $this->serializer->unserialize($value));
        }
    }

    /**
     * @return Allow|void
     */
    public
    function beforeSave() {
//        $label = $this->getData('field_config/label');

//        if ($this->getValue() == '') {
//            throw new ValidatorException(__($label . ' is required.'));
//        } else if (!is_numeric($this->getValue())) {
//            throw new ValidatorException(__($label . ' is not a number.'));
//        } else if ($this->getValue() < 0) {
//            throw new ValidatorException(__($label . ' is less than 0.'));
//        }

        $this->setValue($this->serializer->serialize($this->getValue()));

        parent::beforeSave();
    }

    /**
     * @return Allow
     */
    public
    function afterSave() {
//        $value = $this->getValue();

        return parent::afterSave();
    }
}
