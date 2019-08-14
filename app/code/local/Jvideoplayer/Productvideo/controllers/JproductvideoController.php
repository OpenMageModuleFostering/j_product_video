<?php
   /**
	* @file			JproductvideoController.php
	* @author		P.Karthikeyan <urspsk@gmail.com>
	*
	*/

   /**
	* @brief	Jproductvideo Controller class defination
	*
	* @class	JproductvideoController
	* @see
	*/

class Jvideoplayer_Productvideo_JproductvideoController extends Mage_Core_Controller_Front_Action
{

	/**
	 * @internal Function to fetch the sample video from Downloadable Products
	 * @return Json Data
     */

	public function getProductVideoAction()
	{
		if($this->getRequest()->isXmlHttpRequest())
		{
			$productId		= $this->getRequest()->getParam('id');
			$productModel  	= Mage::getModel('catalog/product');
			$product 		= $productModel->load($productId);

			if($product->getTypeId() == 'downloadable')
			{
				$downloadableProductInstance 	= $product->getTypeInstance();
				$productVideo	 				= $downloadableProductInstance->getSamples($product);
			}

			$i	= 0;
			foreach($productVideo->getData() as $data)
			{
				$productSample[$i]['fileName']	= Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'downloadable/files/samples'.$data['sample_file'];
				$productSample[$i]['title']		= $data['title'];
				$i++;
			}

			echo json_encode($productSample);
		}
	}
}
