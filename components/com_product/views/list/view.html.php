<?php defined('_JEXEC') or die;

class ProductViewList extends JView
{
	function getThumb($image_path, $h, $w = 0)
	{
		$file_div = strrpos($image_path,'.');
		$thumb_ext = substr($image_path, $file_div);
		$thumb_prev = substr($image_path, 0, $file_div);
		$thumb_path =  $thumb_prev . "_sectcont_thumb" . $thumb_ext;
		@unlink($thumb_path);
		$thumb = new Varien_Image_Adapter_Gd2();
		$thumb->keepAspectRatio(true);				$thumb->keepFrame(false);				//$thumb->keepTransparency(true);		//$thumb->backgroundColor(array(255,255,255));
		$thumb->open($image_path)->resize($w, $h)->save($thumb_path)->__destruct();
		return JUri::base() . $thumb_path;
	}

	public function display($tpl = null)
	{
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{

	}
}
