<?php defined('_JEXEC') or die;

class ProductViewBuy extends JView
{
	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		$arr		= array();
		$default 	=  $this->getThumb("components/com_product/assets/upload/default.gif", 100, 125);

		if(JFile::exists(JPATH_COMPONENT . '/assets/upload/' . $this->item->image ))
		{
			$this->image = $this->getThumb('components/com_product/assets/upload/'. $this->item->image, 148, 195);
		}

		parent::display($tpl);
	}

	public function getThumb($image_path, $h, $w = 0)
	{
		$file_div = strrpos($image_path,'.');
		$thumb_ext = substr($image_path, $file_div);
		$thumb_prev = substr($image_path, 0, $file_div);
		$thumb_path =  $thumb_prev . "_sectcont_thumb" . $thumb_ext;
		@unlink($thumb_path);
		$thumb = new Varien_Image_Adapter_Gd2();
		$thumb->keepAspectRatio(true);
		$thumb->keepFrame(false);
		$thumb->open($image_path)->resize($w, $h)->save($thumb_path)->__destruct();
		return JUri::base() . $thumb_path;
	}
}
