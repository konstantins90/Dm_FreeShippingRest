<?php
class Dm_FreeShippingRest_Block_Cart extends Mage_Core_Block_Template
{
    public function getRest()
    {
        $grandTotal = $this->getGrandTotal();
        $freeShippingMin = $this->getMin();
        $rest = $freeShippingMin - $grandTotal;

        return $rest;
    }

    public function getMin()
    {
    	return Mage::getStoreConfig('carriers/freeshipping/free_shipping_subtotal');
    }

    protected function getGrandTotal()
    {
    	$quote = Mage::getModel('checkout/session')->getQuote();
		$cartGrossTotal = 0;
		foreach ($quote->getAllItems() as $item) {
			$cartGrossTotal += $item->getPriceInclTax()*$item->getQty();
		}

		return $cartGrossTotal;
    }
}