<?php
/**
 * @spi
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Theme\Test\Block;

use Mtf\Block\Block;
use Mtf\Client\Locator;

/**
 * Page Top Links block.
 */
class Links extends Block
{
    /**
     * Selector for qty products on compare.
     *
     * @var string
     */
    protected $qtyCompareProducts = '.compare .counter.qty';

    /**
     * Link selector.
     *
     * @var string
     */
    protected $link = '//a[contains(text(), "%s")]';

    /**
     * Welcome message on frontend.
     *
     * @var string
     */
    protected $welcomeMessage = '.greet.welcome';

    /**
     * Open Link by title.
     *
     * @param string $linkTitle
     * @return void
     */
    public function openLink($linkTitle)
    {
        $this->_rootElement->find(sprintf($this->link, $linkTitle), Locator::SELECTOR_XPATH)->click();
    }

    /**
     * Is visible Link by title.
     *
     * @param string $linkTitle
     * @return bool
     */
    public function isLinkVisible($linkTitle)
    {
        return $this->_rootElement->find(sprintf($this->link, $linkTitle), Locator::SELECTOR_XPATH)->isVisible();
    }

    /**
     * Get the number of products added to compare list.
     *
     * @return string
     */
    public function getQtyInCompareList()
    {
        $this->waitForElementVisible($this->qtyCompareProducts);
        $compareProductLink = $this->_rootElement->find($this->qtyCompareProducts);
        preg_match_all('/^\d+/', $compareProductLink->getText(), $matches);
        return $matches[0][0];
    }

    /**
     * Get url from link.
     *
     * @param string $linkTitle
     * @return string
     */
    public function getLinkUrl($linkTitle)
    {
        $link = $this->_rootElement->find(sprintf($this->link, $linkTitle), Locator::SELECTOR_XPATH)
            ->getAttribute('href');

        return trim($link);
    }

    /**
     * Waiter for welcome message.
     *
     * @return void
     */
    public function waitWelcomeMessage()
    {
        $this->waitForElementVisible($this->welcomeMessage);
    }
}
