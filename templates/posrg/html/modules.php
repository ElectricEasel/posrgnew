<?php
defined('_JEXEC') or die;

// Basic
function modChrome_basic($module, &$params, &$attribs)
{
	if ($module->content) {
		echo $module->content;
	}
}

// Standard
function modChrome_standard($module, &$params, &$attribs)
{
    if ($module->title == 'Sidebar Menu')
    {
        $module->title = getSidebarMenuTitle();
    }

	$moduleTag      = $params->get('module_tag', 'div');
	$headerTag      = htmlspecialchars($params->get('header_tag', 'h3'));
	
	if ($params->get('moduleclass_sfx')) {
		$modClassSfx = ' '. $params->get('moduleclass_sfx');
	} else {
		$modClassSfx = '';
	}
	
	if (!empty ($module->content)) : ?>
		<<?php echo $moduleTag; ?> class="module<?php echo htmlspecialchars ($modClassSfx); ?>">

		<?php if ((bool) $module->showtitle) :?>
		<div class="headline">
			<h4><?php echo $module->title; ?></h4>
		</div>
		<?php endif; ?>
			<div class="module-content">
			<?php echo $module->content; ?>
			</div>
		</<?php echo $moduleTag; ?>>
	<?php endif;
}

// Bootstrap
function modChrome_bootstrap($module, $params, $attribs) 
{
	static $modulescount;
	global $modules;

	$modulescount   = count(JModuleHelper::getModules($attribs['name']));
	$bootstrapSize  = (int) $params->get('bootstrap_size', 0);
	$moduleClass    = $bootstrapSize != 0 ? ' span' . $bootstrapSize : '';
	$name           = '';
	
	if ($params->get('moduleclass_sfx')) {
		$modClassSfx = ' '. $params->get('moduleclass_sfx');
	} else {
		$modClassSfx = '';
	}
	
	if (isset($attribs['name'])){
		$name = $attribs['name'];
		if (isset($modules[$name])){
			$modules[$name] += 1;
		} else {
			$modules[$name] = 1;
		}
	}

	if (!empty ($module->content)) {
		$modules[$name] == 1;
		$counter = ($modules[$name]);

		if ($counter == 1) {
			echo '<div class="row">';
		}

		echo '<'.$params->get('module_tag', 'div').' class="module' .$modClassSfx. ' '. $moduleClass .'">';
		if ($module->content) {
			if ($module->showtitle) {
				echo '<div class="module-title">';
				echo '<'.htmlspecialchars($params->get('header_tag', 'h3')).' class="'.$params->get('header_class').'">'. $module->title .'</'.htmlspecialchars($params->get('header_tag', 'h3')).'>';
				echo '</div>';
			}
			echo '<div class="module-content">';
			echo $module->content;
			echo '</div>';
		}
		echo '</'.$params->get('module_tag', 'div').'>';

		if ($counter == $modulescount) {
			echo '</div>';
		}
	}
}

//Chrome
function modChrome_joostrap_style($module, $params, $attribs) 
{
	static $modulescount;
	global $modules;

	$modulescount = count(JModuleHelper::getModules($attribs['name']));
	$name='';
	
	if ($params->get('moduleclass_sfx')) {
		$modClassSfx = ' '. $params->get('moduleclass_sfx');
	} else {
		$modClassSfx = '';
	}
	
	if (isset($attribs['name'])){
		$name = $attribs['name'];
		if (isset($modules[$name])){
			$modules[$name] += 1;
		} else {
			$modules[$name] = 1;
		}
	}

	if (!empty ($module->content)) {
		$modules[$name] == 1;
		$counter = ($modules[$name]);
		
		$modspan = ($modulescount %4);
		
		if ($modspan != 0) {
			if ($modspan == 1) {
				$modspan = 'col-md-12';
			} elseif ($modspan == 2) {
				$modspan = 'col-md-6';
			} elseif ($modspan == 3) {
				$modspan = 'col-md-4';
			}
		} else {
			$modspan = 'col-md-3';
		}
		
		$rest = ($modulescount %4);
		
		if ($rest == 1) {
			$rest = 1;
		} elseif  ($rest == 2) {
			$rest = 2;
		} elseif  ($rest == 3) {
			$rest = 3;
		} else {
			$rest = 4;
		}
		
		if ($counter%4 == 1) {
			echo '<div class="row">';
		}
		if (($counter - 1) >= ($modulescount - $rest)) {
			echo '<div class="'.$modspan.'">';
		} else {
			echo '<div class="col-md-3">';
		}

		echo '<'.$params->get('module_tag', 'div').' class="module'. $modClassSfx .'">';
		if ($module->content) {
			if ($module->showtitle) {
				echo '<div class="module-title">';
				echo '<'.htmlspecialchars($params->get('header_tag', 'h3')).' class="'.$params->get('header_class').'">'. $module->title .'</'.htmlspecialchars($params->get('header_tag', 'h3')).'>';
				echo '</div>';
			}
			echo '<div class="module-content">';
			echo $module->content;
			echo '</div>';
		}
		echo '</'.$params->get('module_tag', 'div').'>';
		echo '</div>';
	
		if (($counter%4 == 0) && ($counter != $modulescount)) {
			echo '</div>';
		}
		
		if ($counter == $modulescount) {
			echo '</div>';
		}
	}
}

function getSidebarMenuTitle() {
    $app =JFactory::getApplication();
    $menu = $app->getMenu();
    $parent = $menu->getActive();
    
    while($parent->parent_id != 1)
    {
        $parent = $menu->getItem($parent->parent_id);
    }

    return $parent->title;
}
