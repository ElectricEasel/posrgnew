<?php
/**
 * @package     Joostrap.Template
 * @subpackage  Base
 *
 * @copyright   Copyright (C) 2005 - 2014 Joostrap. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Template folders for easy management
$tplUrl  = JUri::root(true) . '/templates/' . $this->template;
$tplPath = JPATH_SITE . '/templates/' . $this->template;

/**
 * We will load our own jQuery & Bootstrap HTML classes for 2.5
 * These libraries doesn't work (jQuery & Bootstrap are loaded from template directly)
 * This is here to avoid JHtml errors and improve compatibility
 */
if (version_compare(JVERSION, '3.0', '<'))
{
	JHtml::addIncludePath($tplPath . '/includes/html');
}

// Defaults
$app                = JFactory::getApplication();
$doc                = JFactory::getDocument();
$lang               = JFactory::getLanguage();
$langTag            = $lang->getTag();
$user               = JFactory::getUser();
$this->language     = $doc->language;
$langParts          = explode('-', $this->language);
$htmlLang           = reset($langParts);
$this->direction    = $doc->direction;
$option             = $app->input->getCmd('option', '');
$view               = $app->input->getCmd('view', '');
$layout             = $app->input->getCmd('layout', '');
$task               = $app->input->getCmd('task', '');
$itemid             = $app->input->getCmd('Itemid', '');
$sitename           = $app->getCfg('sitename');
$logo_image         = $this->params->get('logoFile');
$site_title         = $this->params->get('sitetitle');
$site_desc          = $this->params->get('sitedescription');
$logo_margin_top    = $this->params->get('logoMarginTop', 50);
$logo_margin_bottom = $this->params->get('logoMarginBottom', 40);
$color_style        = $this->params->get('templateStyle', '');
$login_button       = $this->params->get('userLogin');
$register_button    = $this->params->get('userRegistration');
$copyrights         = $this->params->get('copyrights');
$copytext           = $this->params->get('copyrightsText');
$ga_id              = $this->params->get('googleAnalitycsCode');
$totop              = $this->params->get('toTop');
$social_icons       = $this->params->get('socialIcons');
$frontpageshow      = $this->params->get('frontpageshow', 0);
$left               = $this->params->get('sidebarLeftWidth', '');
$right              = $this->params->get('sidebarRightWidth', '');
$icon1              = $this->params->get('icon1', '');
$icon1url           = $this->params->get('icon1url ', '');
$icon2              = $this->params->get('icon2', '');
$icon2url           = $this->params->get('icon2url', '');
$icon3              = $this->params->get('icon3', '');
$icon3url           = $this->params->get('icon3url', '');
$icon4              = $this->params->get('icon4', '');
$icon4url           = $this->params->get('icon4url', '');
$icon5              = $this->params->get('icon5', '');
$icon5url           = $this->params->get('icon5url', '');
$icon6              = $this->params->get('icon6', '');
$icon6url           = $this->params->get('icon6url', '');
$menuslide          = $this->params->get('menuslide', '');

// Set the generator metadata
$doc->setGenerator($this->params->get('setGeneratorTag', ''));

/**
 * ==================================================
 * Frontpage check
 * ==================================================
 */
$isFrontpage = false;
$menu = JFactory::getApplication()->getMenu();

// Single language sites
if (!JLanguageMultilang::isEnabled())
{
	if ($menu->getActive() == $menu->getDefault())
	{
		$isFrontpage = true;
	}
}
elseif ($menu->getActive() == $menu->getDefault($langTag))
// Multilanguage sites
{
	$isFrontpage = true;
}

$frontpage = $isFrontpage ? 'frontpage' : '';

$fullWidth = ($task == "edit" || $layout == "form" ) ? 1 : 0;

// Width calculations
$span = '';
$grid = 12;

if ($this->countModules('left') && $this->countModules('right'))
{
	$span = ($grid - ( $left + $right ));
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$span = ($grid - $left);
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$span = ($grid - $right);
}
else
{
	$span = 12;
}

// Chromes
$top      = ($this->params->get('top') == 1) ? "joostrap_style" : "bootstrap";
$standard = ($this->params->get('standard') == 1) ? "joostrap_style" : "bootstrap";
$bottom   = ($this->params->get('bottom') == 1) ? "joostrap_style" : "bootstrap";
$footer   = ($this->params->get('footer') == 1) ? "joostrap_style" : "bootstrap";

// RTL
$rtl_detection = $lang->isRTL() ? ' rtl' : ' no-rtl';

// Extra body classes
$bodyclass      = $this->params->get('bodyclass', ''); // Body Class
$menu           = JFactory::getApplication()->getMenu();
$active         = JFactory::getApplication()->getMenu()->getActive();
$menuname       = $active->title;
$parentId       = $active->tree[0];
$parentName     = $menu->getItem($parentId)->alias;
$params			= $menu->getParams($active->id);
$pageclass 		= $params->get( 'pageclass_sfx' );

if(JFactory::getUser()->guest) {
$loggedin = 'loggedout';
}
else {
$loggedin = 'loggedin';
}
// END - Extra body classes

// Favicon
if ($this->params->get('templateFavicon'))
{
	$this->addFavicon(JURI::root() . $this->params->get('templateFavicon'));
}

// Logo
if ($logo_image)
{
	// Custom logo image
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand"><img src="' . JURI::root() . $logo_image . '" alt="' . $sitename . '" /></a>';
}
elseif (($site_title) && ($site_desc))
{
	// Title and description
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand">' . htmlspecialchars($site_title) . '<span class="site-description">'
	. htmlspecialchars($site_desc) . '</span></a>';
}
elseif (($site_title) && (!$site_desc))
{
	// Title only
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand">' . htmlspecialchars($site_title) . '</a>';
}
else
{
	// Load defalut template logo
	$logo = '<a href="' . $this->baseurl . '/" class="navbar-brand"><img src="' . JURI::root() . 'templates/' . $this->template
	. '/images/logo.png" alt="' . $sitename . '" /></a>';
}

// Logo details from template params
$style = '
	.logo { margin-top:' . $logo_margin_top . 'px; margin-bottom:' . $logo_margin_bottom . 'px; }
';

// Login & Regstration
if ($user->guest)
{
	$logintext = "Login";
}
else
{
	$logintext = "Log Out";
}

if ($user->guest)
{
	$registertext = "Registration";
}
else
{
	$registertext = "My Profile";
}

// Social Icons
$facebook      = $this->params->get('linkFacebook', '');
$twitter       = $this->params->get('linkTwitter', '');
$pinterest     = $this->params->get('linkPinterest', '');
$dribbble      = $this->params->get('linkDribbble', '');
$linkedin      = $this->params->get('linkLinkedIn', '');
$flickr        = $this->params->get('linkFlickr', '');
$youtube       = $this->params->get('linkYoutube', '');
$vimeo         = $this->params->get('linkVimeo', '');
$google_plus   = $this->params->get('linkGooglePlus', '');

// Custom CSS from template params
if (($this->params->get('customCSS')) && ($this->params->get('customCSScode') != ''))
{
	$custom_inline_css = $this->params->get('customCSScode');
	$doc->addStyleDeclaration($custom_inline_css);
}

$doc->addStyleDeclaration($style);

// Google Analytics Embed JS Code
if ($this->params->get('googleAnalitycs'))
{
	$doc->addScriptDeclaration('
		var
		_gaq = _gaq || [];
		_gaq.push([\'_setAccount\', \'' . $ga_id . '\']);
		_gaq.push([\'_trackPageview\']);

		(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();

	');
}

// Google Fonts 1 - chosen from template params
if ($this->params->get('googleFonts'))
{
	$font_family            = $this->params->get('googleFontName');
	$css_selectors          = $this->params->get('googleFontSelectors', '');
	$g1_font_family         = '';

	if ($font_family)
	{
		$doc->addStyleSheet('https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $font_family));

		if ($css_selectors)
		{
			if ((strpos($font_family, ":")) && (strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, ':', true);
			}
			elseif ((strpos($font_family, ":")) && (!strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, ':', true);
			}
			elseif ((!strpos($font_family, ":")) && (strpos($font_family, "&")))
			{
				$g1_font_family = strstr($font_family, '&', true);
			}
			else
			{
				$g1_font_family = $font_family;
			}

			$google_fonts  = $css_selectors . ' { font-family: ' . $g1_font_family . ', sans-serif; }';
			$doc->addStyleDeclaration($google_fonts);
		}
	}
}

// Google Fonts 1 - chosen from template params
if ($this->params->get('googleFontsSecond'))
{
	$second_font_family     = $this->params->get('googleFontNameSecond');
	$second_css_selectors   = $this->params->get('googleFontSelectorsSecond', '');
	$g2_font_family         = '';

	if ($second_font_family)
	{
		$doc->addStyleSheet('https://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $second_font_family));

		if ($second_css_selectors)
		{
			if ((strpos($second_font_family, ":")) && (strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, ':', true);
			}
			elseif ((strpos($second_font_family, ":")) && (!strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, ':', true);
			}
			elseif ((!strpos($second_font_family, ":")) && (strpos($second_font_family, "&")))
			{
				$g2_font_family = strstr($second_font_family, '&', true);
			}
			else
			{
				$g2_font_family = $second_font_family;
			}

			$second_google_fonts  = $second_css_selectors . ' { font-family: ' . $g2_font_family . ', sans-serif; }';
			$doc->addStyleDeclaration($second_google_fonts);
		}
	}
}

/**
 * ==================================================
 * Recompile LESS from the Frontend
 * ==================================================
 */
$loadBootstrap = $this->params->get('loadBootstrap', 1);
$compileLess   = $this->params->get('allowCompile', 0) && $app->input->getCmd('compile', 0);

if ($loadBootstrap && $compileLess)
{
	require_once $tplPath . '/libraries/lessphp/lessc.inc.php';
	$less = new lessc;
	$less->setFormatter("compressed");

	// Source & destination folders
	$cssOutputDir = $tplPath . '/css';
	$bsLessDir = $tplPath . '/less/bootstrap';

	// Compile
	$less->compileFile($bsLessDir . '/bootstrap.less', $cssOutputDir . "/bootstrap.min.css");
}

/**
 * ==================================================
 * Load jQuery? Disable core scripts
 * ==================================================
 */
$loadJquery = $this->params->get('loadJquery', 1);

if ($loadJquery)
{
	$removeJs = array(
		'/jquery.min.js',
		'/jquery.js',
		'/jquery-noconflict.js',
		'/jquery-migrate.min.js',
		'/jquery-migrate.js',
		'/tabs-state.js',
		'/bootstrap.min.js',
		'/bootstrap.js',
	);

	$scripts = $doc->_scripts;

	foreach ($removeJs as $removeScript)
	{
		foreach ($scripts as $script => $scriptdata)
		{
			if (stristr($script, $removeScript))
			{
				unset($scripts[$script]);
			}
		}
	}

	$doc->_scripts = $scripts;
}

/**
 * Function to determine if we have to load the minified version of assets
 * When debug is enabled it would convert:
 * 		$tplUrl . '/css/font-awesome.min.css'
 * into:
 * 		$tplUrl . '/css/font-awesome.css'
 *
 * @param   string  $url  Asset url
 *
 * @return  string
 */
function getDebugAssetUrl($url)
{
	return (JDEBUG) ? str_replace('.min.', '.', $url) : $url;
}

/**
 * ==================================================
 * Custom colors CSS
 * ==================================================
 */
$customColorsCss = null;

// Check if we have to add any CSS
for ($i = 1; $i <= 5; $i++)
{
	if ($colorEnabled = $this->params->get('color' . $i . '_enabled', 0))
	{
		$colorCode     = $this->params->get('color' . $i . '_code', null);
		$colorSelector = $this->params->get('color' . $i . '_selector', null);
		$colorProperty = str_replace('{color}', $colorCode, $this->params->get('color' . $i . '_property', null));

		if ($colorCode && $colorSelector && $colorProperty)
		{
			$customColorsCss .= $colorSelector . " {" . $colorProperty . "}\n";
		}
	}
}
