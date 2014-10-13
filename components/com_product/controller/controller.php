<?php defined('_JEXEC') or die;

class ProductController extends JController
{
	protected $app;

	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT . '/model';
		parent::__construct($config);

		$this->app = JFactory::getApplication();
        $task = $this->app->input->get('task');

        // Check the task for permissions
        $checkTask = array(
            'block',
            'save',
            'saveorder',
            'delete'
        );

        if (in_array($task, $checkTask))
        {
            $this->checkLogin();
            $this->checkTK();
        }
	}

	public function display($cachable = false, $urlparams = false)
	{
		$view = $this->app->input->get('view');

		if (!$task && !$view)
		{
			JRequest::setVar('view', 'list');
			$this->app->input->set('view', 'list');
		}

        // Check the view for permissions
		$checkView = array(
			'form',
			'manager'
		);

		if (in_array($view, $checkView))
		{
			$this->checkLogin();
		}

		parent::display($cachable, $urlparams);
	}

	public function publish()
	{
		$table = new ProductTableProduct;
		$id = $this->app->input->getInt('id');

		if ($table->toggleState($id))
		{
			$this->setMessage('Item state toggled.');
		}
		else
		{
			$this->setMessage('There was an error changing item state.');
		}

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'));
	}

	public function save()
	{
		$post  = JRequest::get('post');
		$table = new ProductTableProduct;
		$id    = $this->app->input->getInt('id');

		if ($id)
		{
			$table->load($id);
		}

		if ($table->save($post))
		{
			$this->setMessage('Product Saved Successfully.');
		}
		else
		{
			$this->setError('There was an error saving.');
		}

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'));
	}

	public function delete()
	{
		$table = new ProductTableProduct;
		$id = $this->app->input->getInt('id');

		if ($table->delete($id))
		{
			$this->setMessage('Product successfully deleted.');
		}
		else
		{
			$this->setError('There was an error deleting the product.');
		}

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'));
	}

	public function upload()
	{
		$this->checkLogin();

		$my			= JFactory::getUser();
		$json		= '{file: "%file", filethumb: "%thumb", message: "%msg", type: "%type"}';
		$file		= JRequest::getVar('file_upload', null, 'files', 'array');
		$filename	= date('Y-m-d H-i-s') . " " . JFile::makeSafe($file['name']);
		$src		= $file['tmp_name'];
		$path		= JPATH_COMPONENT . DS . 'assets' . DS . 'upload';
		$return		= date('Y') . DS . date('m') . DS . $filename;
		$dest		= $path . DS .  $return;
		$ext		= array('jpg', 'png', 'gif');
		$type		= "success";
		$msg		= "";

		if (in_array(strtolower(JFile::getExt($filename)), $ext) )
		{
			if (JFile::upload($src, $dest))
			{
				$msg = JText::_('GM_UPLOAD_SUCCESS');
			}
			else
			{
				$type = 'error';
				$msg = 'GM_NOT_UPLOAD';
			}
		}
		else
		{
			$type = 'error';
			$msg = JText::_('GM_APPLY_FILE') . ' ' . implode(',', $ext);
		}

		$return	= @str_replace(DS, "/", $return);
		$json	= str_replace('%msg', $msg, $json);
		$json	= str_replace('%type', $type, $json);
		$json	= str_replace('%file', $return, $json);
		$json	= str_replace('%thumb', $this->getThumb("components/com_product/assets/upload/" . $return, 50, 50 ), $json);

		$this->app->close($json);
	}

	public function getThumb($image_path, $h, $w = 0)
	{
		$file_div = strrpos($image_path, '.');
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

	public function saveorder()
	{
		$cid = $this->app->input->get('cid', array(), 'array');
		JArrayHelper::toInteger($cid);

		$order = $this->app->input->get('order', array(), 'array' );
		JArrayHelper::toInteger($order);

		$table = new ProductTableProduct;

		if ($table->saveorder($cid, $order))
		{
			$this->setMessage('New ordering saved.');
		}
		else
		{
			$this->setError('There was an error reordering the products.');
		}

		$this->setRedirect( 'index.php?option=com_product&view=manager', $msg );
	}

	protected function checkTK()
	{
        $method = JRequest::getMethod();

		JSession::checkToken($method) or die('Invalid Token');
	}

	protected function checkLogin()
	{
		$user = JFactory::getUser();
		
		$allowed = array('admin', 'posrg');

		if (in_array(strtolower($user->get('username')), $allowed) === false)
		{
			$this->setRedirect('index.php?option=com_users&view=login');
			$this->redirect();
		}
	}

}
