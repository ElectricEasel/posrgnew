<?php


// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

class FamilyViewDetail extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		$id = JRequest::getInt('id', 0);
		
		$model = new mcModel();
		$model
		->setTable('#__family')
		->select()
		->where('id =  ' . $id)		
		;

		

		$document = &JFactory::getDocument();

		// set document information
		$document->setTitle($data->title);
		$document->setName($data->title);
		
		
		
		
		
		
		$this->assignRef('data', $model->getData() );
		
		$field	= array(
			'GM_FAMILY_FORM_SPORT' => 'sport',
			'GM_FAMILY_FORM_FOOD' => 'food',
			'GM_FAMILY_FORM_HOBBY' => 'hobby',
			'GM_FAMILY_FORM_FAVORITE_TRADITION' => 'tradition',
			'GM_FAMILY_FORM_MUSICAL_GROUP' => 'musical_group',
			'GM_FAMILY_FORM_MOVIE' => 'movie',
			'GM_FAMILY_FORM_MEMORY_WIDTH_SPOUSE' => 'memory_width_spouse',
			'GM_FAMILY_FORM_FAMILY_ACTIVITY' => 'family_activity',
			'GM_FAMILY_FORM_DREAM_VACATION' => 'dream_vacation',
			'GM_FAMILY_FORM_CHILDHOOD_MEMORY' => 'childhood_memory',
			'GM_FAMILY_FORM_HOLIDAY' => 'holiday',
			'GM_FAMILY_FORM_TV_SHOW' => 'tv_show',
			'GM_FAMILY_FORM_ANIMAL' => 'animal',
			'GM_FAMILY_FORM_SUBJECT_SCHOOL' => 'subject_school',
			'GM_FAMILY_FORM_CHILDHOOD_TOY' => 'childhood_toy',
			'GM_FAMILY_FORM_BOOK' => 'book',
			
		);
		
		
		
		$this->assignRef('field', $field);
		
		$arr		= array();
		$default 	=  $this->getThumb("components/com_family/assets/upload/default.gif", 0, 125);
		$this->assignRef('our_home_image', $default);
		$this->assignRef('fun_image', $default);
		$this->assignRef('our_extended_image', $default);
		if($this->data->id){
			
			
			
			if(!JFile::exists(JPATH_COMPONENT . DS . 'assets' . DS . 'upload' . DS . $this->data->our_home_image )){
			//	$this->data->our_home_image = $default;
				
			}else{
				//$this->data->our_home_image = 
				$this->assignRef('our_home_image', $this->getThumb("components/com_family/assets/upload/" . $this->data->our_home_image, 0, 125));
			}
			
			if(!JFile::exists(JPATH_COMPONENT . DS . 'assets' . DS . 'upload' . DS . $this->data->fun_image )){
				//$this->data->fun_image = $default;
				
			}else{
				//$this->data->fun_image = $this->getThumb("components/com_family/assets/upload/" . $this->data->fun_image, 0, 50);
				$this->assignRef('fun_image', $this->getThumb("components/com_family/assets/upload/" . $this->data->fun_image, 0, 125));
			}
			
			if(!JFile::exists(JPATH_COMPONENT . DS . 'assets' . DS . 'upload' . DS . $this->data->our_extended_image )){
			//	$this->data->our_extended_image = $default;
				
			}else{
				//$this->data->our_extended_image = $this->getThumb("components/com_family/assets/upload/" . $this->data->our_extended_image, 0, 50);
				$this->assignRef('our_extended_image', $this->getThumb("components/com_family/assets/upload/" . $this->data->our_extended_image, 0, 125));
			}
			
			$image 	= unserialize( $this->data->image );
			
			if(is_array($image)){
				foreach ($image as $_m){
					
					$obj = new stdClass();
					
					if(!JFile::exists(JPATH_COMPONENT . DS . 'assets' . DS . 'upload' . DS . $_m)){
						$obj->value = "";
						$obj->url	= $default;	
					}else {
						$obj->value = $_m;
						$obj->url	= $this->getThumb("components/com_family/assets/upload/" . $_m, 0, 310);
						$arr[] = $obj;
					}
					
				}
			}
			
		}
		
		$this->assignRef('image', $arr);
		
		parent::display($tpl);

		
	}
	
	function getThumb($image_path, $h, $w = 0, $reflections=false){
		
		$file_div = strrpos($image_path,'.');
		$thumb_ext = substr($image_path, $file_div);
		$thumb_prev = substr($image_path, 0, $file_div);
		$thumb_path =  $thumb_prev . "_sectcont_thumb" . $thumb_ext;
			
		$thumb = new Thumbnail($image_path);
				
		if ($thumb->error) { 
			if ($showbug)	echo "JVSECTCONT ERROR: " . $thumb->errmsg . ": " . $image_path; 
			return false;
		}
		$thumb->resize($w, $h);
		if ($reflections) {
			$thumb->createReflection(30,30,60,false);
		}
		if (!is_writable(dirname($thumb_path))) {
			$thumb->destruct();
			return false;
		}
		$thumb->save($thumb_path);
		$thumb->destruct();
		return $thumb_path;
		
	}
}
?>