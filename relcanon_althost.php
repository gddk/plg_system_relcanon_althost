<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.relcanon_althost
 *
 * @copyright   Copyright (C) 2014 Dave Koopman. All rights reserved.
 * @license     GNU/GPL 2.0
 */

//To prevent accessing the document directly
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * plgSystemRelCanon
 *
 * Replaces the rel canonical hostname with the supplied alternate hostname
 */
class plgSystemRelCanon_AltHost extends JPlugin {

	protected $relcanon = null;
	
	function plgSystemRelCanon_AltHost (&$subject, $config) {
		parent::__construct($subject, $config);
	}
	
	function onBeforeCompileHead () {
		$mainframe 		= JFactory::getApplication();
		if ($mainframe->isAdmin()) {
			return;
		}
		$doc = JFactory::getDocument();
		// remove rel canonicals set by Joomla
		foreach ( $doc->_links as $k => $array ) {
			if ( $array['relation'] == 'canonical' ) {
				list ($proto, $url) = explode("://", $k, 2);
				list ($host, $request) = explode("/", $url, 2);
				if ( $request && $this->params->get('use_wp_search', 0) ) {
					$parts = explode("/", $request);
					#remove query string:
					$article = preg_replace("/\?.*/", "", $parts[count($parts)-1]);
					#remove leading 13-  (article id)
					$article = preg_replace("/^\d+\-/", "", $article);
					#replace - with space
					$article = str_replace("-", " ", $article);
					#set the new rel canonical
					$this->relcanon = $proto."://".$this->params->get('alt_host', $host)."/?s=".urlencode($article);
				}
				else
					$this->relcanon = $proto."://".$this->params->get('alt_host', $host)."/".$request;
				unset($doc->_links[$k]);
			}
		}
		
		// Set the correct URL as rel canonical
		if(!empty($this->relcanon)){
			$doc->addHeadLink(htmlspecialchars($this->relcanon), 'canonical');
		}
	}
}