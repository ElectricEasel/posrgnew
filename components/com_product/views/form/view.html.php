<?php defined('_JEXEC') or die;

class ProductViewForm extends JView
{
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

	public function display($tpl = null)
	{
		$this->item = $this->get('Item');

		$arr = array(
			(object) array(
				'value' => 0,
				'text'  => JText::_('GM_PRODUCT_FORM_STATUS_N')
			),
			(object) array(
				'value'	=> '1',
				'text'  => JText::_('GM_PRODUCT_FORM_STATUS_Y')
			)
		);

		$this->status = JHtml::_('select.genericlist', $arr, 'frontpage', 'class="gm-input"', 'value', 'text', $this->item->frontpage);

		$this->profile_image = $this->getThumb('components/com_product/assets/upload/upload.gif', 50, 50);

		if(JFile::exists(JPATH_COMPONENT . '/assets/upload/' . $this->item->image))
		{
			$this->profile_img = $this->getThumb('components/com_product/assets/upload/' . $this->item->image, 50, 50);
		}

		$this->prepareDocument();

		parent::display($tpl);
	}

	protected function prepareDocument()
	{
		JFactory::getDocument()
			->addScript('components/com_product/assets/js/ajaxupload.js')
			->addScriptDeclaration('
			// <![CDATA[
			jQuery(document).ready(function($){

				$("#cancel").click(function(){
					document.location.href = "' . JRoute::_('index.php?option=com_product&view=manager') . '";
				});

				$(".jmc-upload").each(function(A, B){
					var self = B;
					new AjaxUpload($(B), {
						action: "<?php echo JUri::base() ?>index.php?option=com_product&task=upload",
						name:  "file_upload",
						data: {},
						responseType: "json",
						onComplete: function(file, response) {
							if(response){
								alert(response.message);
								if(response.type == "success"){

									$(self)
										.children("img")
										.addClass("size-min")
										.attr("src", "' . JUri::base() . 'components/com_product/assets/upload/" + response.file);

									$(self)
										.children("input")
										.val(response.file);
								}

							}
						}
					});
				});
			});
			// ]]>
			');
	}
}
