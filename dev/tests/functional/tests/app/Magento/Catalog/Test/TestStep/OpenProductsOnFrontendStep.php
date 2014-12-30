<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Catalog\Test\TestStep;

use Mtf\Client\BrowserInterface;
use Mtf\TestStep\TestStepInterface;

/**
 * Open products on frontend via url.
 */
class OpenProductsOnFrontendStep implements TestStepInterface
{
    /**
     * Products fixtures.
     *
     * @var array
     */
    protected $products = [];

    /**
     * Browser.
     *
     * @var BrowserInterface
     */
    protected $browser;

    /**
     * Preparing step properties.
     *
     * @constructor
     * @param array $products
     * @param BrowserInterface $browser
     */
    public function __construct(array $products, BrowserInterface $browser)
    {
        $this->products = $products;
        $this->browser = $browser;
    }

    /**
     * Open products on frontend via url.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->products as $product) {
            $this->browser->open($_ENV['app_frontend_url'] . $product->getUrlKey() . '.html');
        }
    }
}
