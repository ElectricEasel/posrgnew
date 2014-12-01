<?php defined('_JEXEC') or die;

/**
 * @version 1.0
 * @license GPL, http://www.gnu.org/copyleft/gpl.html
 *
 * shortcode for inside article editor
 * replaces datetime string
 * plugin format = {datetime "m-d-y"}
 * "m-d-y" can be any php datetime string
 */
class plgContentDatetime extends JPlugin
{
    function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		$option = JRequest::getVar('option');
		$task 	= JRequest::getVar('task');
		if ($option == 'com_content' && $task == 'edit')
			return true;
		
		if (strpos($article->text, '{datetime ') === false)
			return true;
		
		// expression to search for
		$pattern = '#\{datetime ([\"\'])(.*)\1\}#i';
		if (preg_match_all($pattern, $article->text, $matches))
		{
			$doc = JFactory::getDocument();
			if ($doc->getType() != 'html') {
				$article->text = preg_replace($pattern, '', $article->text);
				return true;
			}

			foreach ($matches[0] as $i => $match)
			{
                $article->text = str_replace($matches[0][$i], date($matches[2][$i]), $article->text);
            }
        }
		
		return true;
	}
}