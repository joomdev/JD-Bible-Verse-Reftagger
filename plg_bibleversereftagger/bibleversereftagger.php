<?php
/**
 * @package     BibleVerseReftagger.Plugin
 * @subpackage  System.BibleVerseReftagger
 * @copyright   Copyright (C) 2020 Joomdev, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
jimport( 'joomla.plugin.plugin' );

/**
 * System plugin to bibleversereftagger terms.
 *
 * @since  3.0
 */
class PlgSystemBibleVerseReftagger extends JPlugin {
    
    public function __construct( &$subject, $params ){
		parent::__construct( $subject, $params );
		$this->paramObj = new JRegistry($params['params']);
		}

  public function onAfterRender()
  {
      $app = JFactory::getApplication();
      $bibleTranslation = $this->paramObj->get('bibleTranslation','');
      $addLogosLink = $this->paramObj->get('addLogosLink','');
      $useLogosLink = $this->paramObj->get('useLogosLink','');
      $logosLinkIcon = $this->paramObj->get('logosLinkIcon','');
      $noSearchTagNames = $this->paramObj->get('noSearchTagNames','');
      $tagChapters = $this->paramObj->get('tagChapters','');
      $convertHyperlinks = $this->paramObj->get('convertHyperlinks','');
      $caseInsensitive = $this->paramObj->get('caseInsensitive','');
      $noSearchClassNames = $this->paramObj->get('noSearchClassNames','');
      $useTooltip = $this->paramObj->get('useTooltip','');
      $showFaithlife = $this->paramObj->get('showFaithlife','');
      $showTwitter = $this->paramObj->get('showTwitter','');
      $showFacebook = $this->paramObj->get('showFacebook','');
      $showGoogle = $this->paramObj->get('showGoogle','');
      $dropShadow = $this->paramObj->get('dropShadow','');
      $openWindow = $this->paramObj->get('openWindow','');
      $roundedCorners = $this->paramObj->get('roundedCorners','');
      $backgroundStyle = $this->paramObj->get('backgroundStyle','');
      $headerBackgroundColor = $this->paramObj->get('headerBackgroundColor','');
      $headerFontColor = $this->paramObj->get('headerFontColor','');
      $headerFont = $this->paramObj->get('headerFont','');
      $headerFontSize = $this->paramObj->get('headerFontSize','');
      $bodyFontColor = $this->paramObj->get('bodyFontColor','');
      $bodyFont = $this->paramObj->get('bodyFont','');
      $bodyFontSize = $this->paramObj->get('bodyFontSize','');

      // only insert the script in the frontend
      if ($app->isClient('site')) {

          // retrieve all the response as an html string
          $html = $app->getBody();
          
          // Supporting in-line CSS
          $styles = [
              ".rtTooltipBrandLink a:hover,.rtTooltipBrandLink a:link,.rtTooltipBrandLink a:visited,.rtTooltipMoreLink:hover,.rtTooltipMoreLink:link,.rtTooltipMoreLink:visited{display:$useLogosLink !important;}"  
          ];
          $tagging = "";
          foreach($styles as $q){
              $tagging .= '<style>' . $q . '</style>';
          }
          $html = str_replace('</body>',$tagging . '</body>',$html);

          // Supporting JD Bible Verse Reftagger options and script call
          $scripts = [
              "var refTagger = {
		          settings: {
                    bibleVersion: '$bibleTranslation',
                    addLogosLink: $addLogosLink,
                    logosLinkIcon: '$logosLinkIcon',
                    noSearchTagNames: [$noSearchTagNames],
                    tagChapters: $tagChapters,
                    convertHyperlinks: $convertHyperlinks,
                    caseInsensitive: $caseInsensitive,
                    noSearchClassNames: [$noSearchClassNames],
                    useTooltip: $useTooltip,
                    socialSharing: ['$showFaithlife','$showTwitter','$showFacebook','$showGoogle'],
                    dropShadow: $dropShadow,
                    linksOpenNewWindow: $openWindow,
                    roundCorners: $roundedCorners,
                    tooltipStyle: '$backgroundStyle',
                    customStyle : {
                        heading: {
					       backgroundColor : '$headerBackgroundColor',
                           color: '$headerFontColor',
                           fontFamily: '$headerFont',
                           fontSize: '$headerFontSize'
                        },
				        body: {
					       color : '$bodyFontColor',
                           fontFamily: '$bodyFont',
                           fontSize: '$bodyFontSize'
                        }
                    }
                }
            };
                    (function(d, t) {
		                  var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		                  g.src = '//api.reftagger.com/v2/RefTagger.js';
		                  s.parentNode.insertBefore(g, s);
	                   }(document, 'script'));
                ",
              ];
          
          $tags = "";
          foreach($scripts as $s){
              //$tags .= '<script src="' . $s . '"></script>';
              $tags .= '<script>' . $s . '</script>';
          }

          $html = str_replace('</body>',$tags . '</body>',$html);

          // override the original response
          $app->setBody($html);
        }
    }
}