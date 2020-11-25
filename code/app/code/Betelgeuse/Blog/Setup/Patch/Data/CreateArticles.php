<?php
namespace Betelgeuse\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class EnableSegmentation.
 *
 * @package Magento\Catalog\Setup\Patch
 */
class CreateArticles implements DataPatchInterface {

    /**
     * @var \Betelgeuse\Blog\Model\ArticleFactory
     */
    private $articleFactory;

    /**
     * EnableSegmentation constructor.
     *
     * @param \Betelgeuse\Blog\Model\ArticleFactory $articleFactory
     */
    public
    function __construct(
        \Betelgeuse\Blog\Model\ArticleFactory $articleFactory
    ) {
        $this->articleFactory = $articleFactory;
    }

    /**
     * {@inheritdoc}
     */
    public
    function apply() {
        $data = [
            [
                'author' => 'Author',
                'title' => 'Title',
                'description' => 'Description',
                'content' => 'Content',
                'status' => 1,
                'enabled' => 1,
            ],
            [
                'author' => 'Author2',
                'title' => 'Title',
                'description' => 'Description',
                'content' => 'Content',
                'status' => 0,
                'enabled' => 0,
            ],
            [
                'author' => 'Author3',
                'title' => 'Title',
                'description' => 'Description',
                'content' => 'Content',
                'status' => 1,
                'enabled' => 1,
            ],
            [
                'author' => 'Author4',
                'title' => 'Title',
                'description' => 'Description',
                'content' => 'Content',
                'status' => 0,
                'enabled' => 1,
            ],
            [
                'author' => 'Author5',
                'title' => 'Title',
                'description' => 'Description',
                'content' => 'Content',
                'status' => 1,
                'enabled' => 0,
            ],
        ];

        /** @var \Betelgeuse\Blog\Model\Article $article */
        $article = $this->articleFactory->create();

        foreach ($data as $item) {
            // $article->setAuthor($item['author']) ...

            $article->setData([
                'author' => $item['author'],
                'title' => $item['title'],
                'description' => $item['description'],
                'content' => $item['content'],
                'status' => $item['status'],
                'enabled' => $item['enabled']
            ]);

            $article->save();
        }
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
