<?php

/**
 * @file		Jproductvideo.php
 *
 * @category   	Productvideo
 * @author     	P.Karthikeyan(urspsk@gmail.com)
 * 
 */

/**
 * @brief 		Jproductvideo Class defination
 *
 * @class		Jproductvideo
 * @see
 */

class Jvideoplayer_Productvideo_Block_Jproductvideo extends Mage_Catalog_Block_Product_Abstract
{

	 /**
     * @internal Get Product root Category
     * @return string
     */
	public function getProductCategory()
	{

		$productId 	= Mage::registry('current_product')->getId();
		$product 	= Mage::getModel('catalog/product')->load($productId);

		if(!$product->getCategoryId())
		{
			$categoryids	= $product->getCategoryIds();

			if(count($categoryids) != 1)
			{
				$category_id	= $categoryids[1];
			}
			else
			{
				$category_id	= $categoryids[0];
			}
		}
		else
		{
			$categoryid		= $product->getCategoryId();
			$category 		= Mage::getModel('catalog/category')->load($categoryid);
			$categoryids	= $category->getParentIds();

			if(count($categoryids) != 2)
			{
				$category_id	= $categoryids[2];
			}
			else
			{
				$category_id	= $categoryid;
			}
		}

		$category 	= Mage::getModel('catalog/category')->load($category_id);

		return $category->getName();
	}

	/**
     * @internal To Check whether the product is Downloadable
     *
     * @return Boolean
     */

	public function isDownloadable($productId)
	{
		$productModel  	= Mage::getModel('catalog/product');
		$product 	= $productModel->load($productId);

		if($product->getTypeId() != 'downloadable')
		{
			return false;
		}
		$downloadableProductInstance 	= $product->getTypeInstance();
		$audioSample	 				= $downloadableProductInstance->getSamples($product);
		if(!$audioSample->getData())
		{
			return false;
		}

		return true;
	}

};

