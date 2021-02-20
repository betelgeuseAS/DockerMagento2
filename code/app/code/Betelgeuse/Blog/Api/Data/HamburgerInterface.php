<?php
namespace Betelgeuse\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface HamburgerInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
//     * @return \Betelgeuse\Blog\Api\Data\IngredientInterface[]
     * @return mixed
     */
    public function getIngredients();

    /**
//     * @param \Betelgeuse\Blog\Api\Data\IngredientInterface[] $ingredients
     * @param mixed
     * @return void
     */
    public function setIngredients(array $ingredients);

    /**
     * @return string[]
     */
    public function getImageUrls();

    /**
     * @param string[] $urls
     * @return void
     */
    public function setImageUrls(array $urls);

    /**
     * @return \Betelgeuse\Blog\Api\Data\HamburgerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * @param \Betelgeuse\Blog\Api\Data\HamburgerExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(HamburgerExtensionInterface $extensionAttributes);
}
