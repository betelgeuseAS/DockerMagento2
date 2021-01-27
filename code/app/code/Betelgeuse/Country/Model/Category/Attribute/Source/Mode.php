<?php
namespace Betelgeuse\Country\Model\Category\Attribute\Source;

/**
 * Class Mode
 * @package Betelgeuse\Country\Model\Category\Attribute\Source
 */
class Mode extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource {

    /**
     * @var \Magento\Framework\App\CacheInterface
     */
    protected $_cacheManager;

    private $curl;

    /**
     * Constructor.
     *
     * @param Magento\Framework\HTTP\Client\Curl $curl
     */
    public function __construct(\Magento\Framework\HTTP\Client\Curl $curl, \Magento\Framework\App\CacheInterface $cacheManager){
        $this->curl = $curl;
        $this->_cacheManager = $cacheManager;
    }


    /**
     * {@inheritdoc}
     * @codeCoverageIgnore
     */
    public
    function getAllOptions() {
        $result = $this->_cacheManager->load('cacheTestId');

        if (!$result) {
            $this->curl->get('https://gist.githubusercontent.com/keeguon/2310008/raw/bdc2ce1c1e3f28f9cab5b4393c7549f38361be4e/countries.json');
            $result = $this->curl->getBody();

            $text = str_replace("'", '"', $result);
            $text = str_replace("{", "{\"", $text);
            $text = str_replace(":", "\":", $text);
            $text = str_replace("\", ", "\", \"", $text);

            $items = \GuzzleHttp\json_decode($text);

            $this->_options = [];

            foreach ($items as $item) {
                $this->_options[] = ['value' => $item->code, 'label' => $item->name];
            }

            $this->_cacheManager->save(serialize($this->_options), 'cacheTestId');
        } else {
            $this->_options = unserialize($result);
        }

//        if (!$this->_options) {
//            $this->_options = [
//                ['value' => \Magento\Catalog\Model\Category::DM_PRODUCT, 'label' => __('Products only')],
//                ['value' => \Magento\Catalog\Model\Category::DM_PAGE, 'label' => __('Static block only')],
//                ['value' => \Magento\Catalog\Model\Category::DM_MIXED, 'label' => __('Static block and products')],
//            ];
//        }

        return $this->_options;
    }
}
