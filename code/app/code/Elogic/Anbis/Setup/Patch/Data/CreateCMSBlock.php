<?php
namespace Elogic\Anbis\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class CreateCMSBlock
 * @package Elogic\Anbis\Setup\Patch\Data
 */
class CreateCMSBlock implements DataPatchInterface {

    /**
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected $blockFactory;

    /**
     * @var \Magento\Cms\Model\BlockRepository
     */
    protected $blockRepository;

    /**
     * @param PageFactory $resultPageFactory
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     * @param \Magento\Cms\Model\BlockRepository $blockRepository
     */
    public function __construct(
        PageFactory $resultPageFactory,
        \Magento\Cms\Model\BlockFactory $blockFactory,
        \Magento\Cms\Model\BlockRepository $blockRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->blockFactory = $blockFactory;
        $this->blockRepository = $blockRepository;
    }

    /**
     * {@inheritdoc}
     */
    public
    function apply() {
//        $page = $this->pageFactory->create();
//        $page->setTitle('Example CMS page')
//            ->setIdentifier('example-cms-page')
//            ->setIsActive(true)
//            ->setPageLayout('1column')
//            ->setStores(array(0))
//            ->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
//            ->save();

        $data = [
            'title' => 'Test block title',
            'identifier' => 'test-block',
            'stores' => ['0'],
            'is_active' => 1,
            'content' => 'Test block content'
        ];
        $newBlock = $this->blockFactory->create(['data' => $data]);
        $this->blockRepository->save($newBlock);
    }

    /**
     * {@inheritdoc}
     */
    public static
    function getDependencies() {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public
    function getAliases() {
        return [];
    }
}
