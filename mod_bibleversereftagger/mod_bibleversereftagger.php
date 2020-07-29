<?php
/*-------------------------------------------------------------------------------
# mod_bibleversereftagger - Bible verse scripting module for Joomla 3.x v3.0.0
# -------------------------------------------------------------------------------
# author    JoomDev (Formerly GraphicAholic)
# copyright Copyright (C) 2020 Joomdev, Inc. All rights reserved.
# @license - GNU General Public License version 2 or later
# Websites: https://www.joomdev.com
--------------------------------------------------------------------------------*/
// No direct access
defined('_JEXEC') or die('Restricted access');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
JHtml::_('bootstrap.framework');
// Import the file / foldersystem
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
$document = JFactory::getDocument();
$modbase = JURI::base(true).'/modules/mod_bibleversereftagger/';
?>
<style>
.rtTooltipBrandLink a:hover,.rtTooltipBrandLink a:link,.rtTooltipBrandLink a:visited,.rtTooltipMoreLink:hover,.rtTooltipMoreLink:link,.rtTooltipMoreLink:visited{display:<?php echo $params->get('useLogosLink') ?> !important;}
</style>
<script>
	var refTagger = {
		settings: {
			bibleVersion: "<?php echo $params->get('bibleTranslation') ?>",
            addLogosLink: <?php echo $params->get('addLogosLink') ?>,
            logosLinkIcon: "<?php echo $params->get('logosLinkIcon') ?>",
			noSearchTagNames: [<?php echo $params->get('noSearchTagNames') ?>],
            tagChapters: <?php echo $params->get('tagChapters') ?>,
            convertHyperlinks: <?php echo $params->get('convertHyperlinks') ?>,
            caseInsensitive: <?php echo $params->get('caseInsensitive') ?>,
            noSearchClassNames: [<?php echo $params->get('noSearchClassNames') ?>],
            useTooltip: <?php echo $params->get('useTooltip') ?>,
			socialSharing: ["<?php echo $params->get('showFaithlife') ?>","<?php echo $params->get('showTwitter') ?>","<?php echo $params->get('showFacebook') ?>","<?php echo $params->get('showGoogle') ?>"],
			dropShadow: <?php echo $params->get('dropShadow') ?>, 
			linksOpenNewWindow: <?php echo $params->get('openWindow') ?>,			
			roundCorners: <?php echo $params->get('roundedCorners') ?>,			
			tooltipStyle: "<?php echo $params->get('backgroundStyle') ?>",
			customStyle : {
				heading: {
					backgroundColor : "<?php echo $params->get('headerBackgroundColor') ?>",
					color : "<?php echo $params->get('headerFontColor') ?>",
					fontFamily : "<?php echo $params->get('headerFont') ?>",
					fontSize : "<?php echo $params->get('headerFontSize') ?>"
				},
				body   : {
					color : "<?php echo $params->get('bodyFontColor') ?>",
					fontFamily : "<?php echo $params->get('bodyFont') ?>",
					fontSize : "<?php echo $params->get('bodyFontSize') ?>"
				}
			}
		}
	};
	(function(d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = "//api.reftagger.com/v2/RefTagger.js";
		s.parentNode.insertBefore(g, s);
	}(document, "script"));
</script>