<?php
//$currentLocal = setlocale(LC_CTYPE, array('ru_RU.utf-8', 'rus_RUS.utf-8'));

$bitrix = $joomla = $joomla3 = $wordpress = $drupal = $opencart = $kandidatCMS = $hostCMS = $scriptoCMS = $WebAsystN = $WebAsystO = $magento = $other = $CMSMadeSimple = $Simpla = $GetSimpleCMS = $AbanteCMS = $VamShop = $DLE = $MODXEvolution = $MODXRevolution = $Prestashop = $UMICMS = $diafan = $peredovik = $netcat = false;

if (file_exists($newPatn.'/bitrix/php_interface/dbconn.php') || file_exists($newPatn.'/local/bitrix/php_interface/dbconn.php')) $bitrix = true;
if (file_exists($newPatn.'/configuration.php') && file_exists($newPatn.'/includes/application.php')) $joomla = true;
if (file_exists($newPatn.'/configuration.php') && file_exists($newPatn.'/libraries/cms/application/cms.php')) $joomla3 = true;
if (file_exists($newPatn.'/configuration.php') && file_exists($newPatn.'/libraries/src/Application/CMSApplication.php')) $joomla3 = true;
if (file_exists($newPatn.'/wp-config.php')) $wordpress = true;
if (file_exists($newPatn.'/sites/default/settings.php')) $drupal = true;
if (file_exists($newPatn.'/catalog/controller/common/header.php') && file_exists($newPatn.'/system/engine/controller.php')) $opencart = true;
if (file_exists($newPatn.'/admin/conf/config.inc') && file_exists($newPatn.'/engine/config.php')) $kandidatCMS = true;
if (file_exists($newPatn.'/templates/template1/template.htm') && file_exists($newPatn.'/hostcmsfiles/.htaccess')) $hostCMS = true;
if (file_exists($newPatn.'/config/main.config.php') && file_exists($newPatn.'/core/classes/engine.class.php')) $scriptoCMS = true;
if (file_exists($newPatn.'/wa-system/response/waResponse.class.php') && file_exists($newPatn.'/wa-config/db.php')) $WebAsystN = true;
if (file_exists($newPatn.'/published/SC/html/scripts/index.php') && file_exists($newPatn.'/kernel/kernel.php')) $WebAsystO = true;
if (file_exists($newPatn.'/app/code/core/Mage/Page/Block/Html/Head.php')) $magento = true;
if (file_exists($newPatn.'/lib/classes/class.content.inc.php') && file_exists($newPatn.'/lib/classes/class.pageinfo.inc.php')) $CMSMadeSimple = true;
if (file_exists($newPatn.'/Smarty/libs/Smarty.class.php') && file_exists($newPatn.'/design/default/html/index.tpl')) $Simpla = true;
if (file_exists($newPatn.'/admin/inc/theme_functions.php') && file_exists($newPatn.'/admin/inc/template_functions.php')) $GetSimpleCMS = true;
if (file_exists($newPatn.'/engine/display_screen.php')) $AbanteCMS = true;
if (file_exists($newPatn.'/includes/modules/metatags.php') && file_exists($newPatn.'/includes/classes/vam_template.php')) $VamShop = true;
if (file_exists($newPatn.'/engine/engine.php') && file_exists($newPatn.'/engine/data/dbconfig.php')) $DLE = true;
if (file_exists($newPatn.'/manager/includes/document.parser.class.inc.php') && file_exists($newPatn.'/manager/includes/config.inc.php')) $MODXEvolution = true;
if (file_exists($newPatn.'/core/config/config.inc.php') && file_exists($newPatn.'/connectors/config.core.php')) $MODXRevolution = true;
if (file_exists($newPatn.'/classes/Meta.php') && file_exists($newPatn.'/classes/Tools.php')) $Prestashop = true;
if (file_exists($newPatn.'/xsltTpls/common.xsl') && file_exists($newPatn.'/config.ini')) $UMICMS = true;
if (file_exists($newPatn.'/includes/diafan.php') && file_exists($newPatn.'/themes/functions/show_head.php')) $diafan = true;
if (file_exists($newPatn.'/includes/dbconnect.php') && file_exists($newPatn.'/includes/classes/HTML.php')) $peredovik = true;
if (file_exists($newPatn.'/netcat/index.php')) $netcat = true;

if (empty($_SERVER['HTTPS'])){$serverProtocol = 'http';}else{$serverProtocol = 'https';}
$serverHost = $_SERVER["HTTP_HOST"];
$serverHost = str_replace("www.", "", $serverHost);
$serverDomainFull = $serverProtocol.'://'.$serverHost;

include_once 'parse.php';

 foreach($massObj as $ms){

	$msURL = str_replace("www.", "", $ms["url"]);
	$toUrl = str_replace($serverDomainFull, "", $msURL);
	//$toUrl = urldecode(iconv("CP1251", "UTF-8", $toUrl)); // расскоментировать при наличии кирилицы в урле
	
	
	if(isset($currentLocal) && $currentLocal == 'ru_RU.utf-8'){
		$toTitle = $ms["title"];
		$toDescr = $ms["description"];
		$toKey = $ms["keywords"];
	}else{
		$toTitle = iconv("CP1251", "UTF-8", $ms["title"]);
		$toDescr = iconv("CP1251", "UTF-8", $ms["description"]);
		$toKey = iconv("CP1251", "UTF-8", $ms["keywords"]);
	}


	$switchUrl = '';
	if(isset($_SERVER['REDIRECT_URL'])) $redirectURL = $_SERVER['REDIRECT_URL'];
	$requestURI = $_SERVER['REQUEST_URI'];
	
	if(isset($redirectURL)){
		if($redirectURL != "" && $redirectURL != $requestURI && $redirectURL != '/index.php' && $redirectURL.'?'.$_SERVER['QUERY_STRING'] != $requestURI){
		$switchUrl = $redirectURL;
		}else{
		$switchUrl = $requestURI;
		}
	}else{
		$switchUrl = $requestURI;
	}
	
	//$switchUrl = urldecode($switchUrl); // расскоментировать при наличии кирилицы
	switch($switchUrl){
	case ''.$toUrl.'' :
	$T = ''.$toTitle.'';
	$D = ''.$toDescr.'';
	$K = ''.$toKey.'';
	break;

	}
	
}

if($bitrix){ //Bitrix

	if(!empty($T)) $metaTitle = $T;
	if(!empty($D)) $metaDesc =	'<meta name="description" content="'.$D.'" />';
	if(!empty($K)) $metaKey = '<meta name="keywords" content="'.$K.'" />';
	
}
if($joomla){ //Joomla 1.5 - 2.5

	if(isset($T)&&trim($T)!='') $document->title = $T; //$shCustomTitleTag = $T;
	if(isset($D)&&trim($D)!='') $document->description = $D; //$shCustomDescriptionTag = $D;
	if(isset($K)&&trim($K)!='') $document->_metaTags['standard']['keywords'] = $K; //$shCustomKeywordsTag = $K;
}
if($joomla3){ //Joomla 3

	if(isset($T)&&!empty($T)){$data=preg_replace('/\<\s*title\s*\>.*\<\s*\/title\s*\>/isU','<title>'.$T.'</title>', $data); unset($T);}
	if(isset($D)&&!empty($D)){
	if(preg_match('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU',$data)) 
	$data=preg_replace('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$data); 
	else $data=preg_replace('/<\s*\/title\s*\>/', '</title>'.PHP_EOL.'<meta name="description" content="'.$D.'" />',$data);
	unset($D);
	}
	if(isset($K)&&!empty($K)){
	if(preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\/\>/isU',$data)) 
	$data=preg_replace('/\<\s*meta\s+name\s*=\s*"keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$data); 
	else $data=preg_replace('/<\s*\/title\s*\>/', '</title>'.PHP_EOL.'<meta name="keywords" content="'.$K.'" />',$data); 
	unset($K);
	}

}
if($wordpress){ //Wordpress

	if(!empty($T))	$metaTitle = $T;
	if(!empty($D))	$metaDesc = $D;
	if(!empty($K))	$metaKey = $K;

}
if($drupal){ //Drupal 7

	if(isset($T)&&!empty($T)){ $head_title = $T; unset($T);}
	if(isset($D)&&!empty($D)){
		
	if(preg_match('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU',$head)){
		$head = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$head);
	}else{
		$head .= '<meta name="description" content="....." />';
		$head = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$head);
	}
	unset($D);
	}
	if(isset($K)&&!empty($K)){
	if(preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\/\>/isU',$head)){
		$head = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$head);
	}else{
		$head .= '<meta name="keywords" content="....." />';
		$head = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$head); 
	}
	unset($D);
	}

}
if($opencart){ // Opencart

	if(!empty($T)){
	if(!$this->data) $data['title'] = $T; else $this->data['title'] = $T;
	unset($T);
	}
	if(!empty($D)){
	if(!$this->data) $data['description'] = $D; else $this->data['description'] = $D;
	unset($D);
	}
	if(!empty($K)){
	if(!$this->data) $data['keywords'] = $K; else $this->data['keywords'] = $K;
	unset($K);
	}

}
if($kandidatCMS){ // KandidatCMS

	if(!empty($T)) $sitetitle = $T;
	if(!empty($D)) $metadescription = $D;
	if(!empty($K)) $metakeywords = $K;

}
if($hostCMS){ // HostCMS

	if(!empty($T)) $T = $T;
	if(!empty($D)) $D = $D;
	if(!empty($K)) $K = $K;

}
if($scriptoCMS){ // ScriptoCMS

	if(!empty($T)) $this->assign('mtitle', $T);
	if(!empty($D)) $this->assign('mdesc', $D);
	if(!empty($K)) $this->assign('mkey', $K);

}
if($WebAsystN){ // WebAsyst новый

	if(!empty($T)) $meta['title'] = $category['meta_title'] = $meta_fields['meta_title'] = $post['meta_title'] = $page['title'] = $title = $T;
	if(!empty($D)) $meta['description'] = $category['meta_description'] = $meta_fields['meta_description'] = $post['meta_description'] = $page['description'] = $D;
	if(!empty($K)) $meta['keywords'] = $category['meta_keywords'] = $meta_fields['meta_keywords'] = $post['meta_keywords'] = $page['keywords'] = $K;
	if($meta[$name]) $this->metas[$name] = $meta[$name];
}
if($WebAsystO){ // WebAsyst старый

	if(isset($T)){if(trim($T)!='')$page=preg_replace('/\<\s*title\s*\>.*\<\s*\/title\s*\>/isU','<title>'.$T.'</title>', $page); unset($T);}
	if(isset($D)){
	if(trim($D)!='' && preg_match('/\<\s*meta\s+name\s*=\s*"description.*\>/isU',$page)) 
	$page=preg_replace('/\<\s*meta\s+name\s*=\s*"description.*\>/isU','<meta name="description" content="'.$D.'" />',$page); 
	else $page=preg_replace('/<\s*\/title\s*\>/', '</title>'.PHP_EOL.'<meta name="description" content="'.$D.'" />',$page);
	unset($D);
	}
	if(isset($K)){
	if(trim($K)!='' && preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU',$page)) 
	$page=preg_replace('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU','<meta name="keywords" content="'.$K.'" />',$page); 
	else $page=preg_replace('/<\s*\/title\s*\>/', '</title>'.PHP_EOL.'<meta name="keywords" content="'.$K.'" />',$page); 
	unset($K);
	}
}
if($magento){ // Magento

	if(isset($T)&&trim($T)!='') $this->_data['title'] = $T;
	if(isset($D)&&trim($D)!='') $this->_data['description'] = $D;
	if(isset($K)&&trim($K)!='') $this->_data['keywords'] = $K;
}
if($CMSMadeSimple){ // CMS Made Simple
	
	if(isset($T)&&trim($T)!='') $this->mName = $T;
	if(isset($D)&&!empty($D)){	
	if(preg_match('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU',$this->mMetadata)){
		$this->mMetadata = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$this->mMetadata);
	}else{
		$this->mMetadata .= '<meta name="description" content="....." />';
		$this->mMetadata = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$this->mMetadata);
	}
	unset($D);
	}
	if(isset($K)&&!empty($K)){
	if(preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\/\>/isU',$this->mMetadata)){
		$this->mMetadata = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$this->mMetadata);
	}else{
		$this->mMetadata .= '<meta name="keywords" content="....." />';
		$this->mMetadata = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$this->mMetadata); 
	}
	unset($D);
	}
}
if($Simpla){ // Simpla

	if(isset($T)&&!empty($T)){$site->body=preg_replace('/\<\s*title\s*\>.*\<\s*\/title\s*\>/isU','<title>'.$T.'</title>', $site->body); unset($T);}
	if(isset($D)&&!empty($D)){	
	if(preg_match('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU',$site->body)){
		$site->body = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$site->body);
	}else{
		$site->body .= '<meta name="description" content="....." />';
		$site->body = preg_replace('/<meta name="description.*\/\>/isU','<meta name="description" content="'.$D.'" />',$site->body);
	}
	unset($D);
	}
	if(isset($K)&&!empty($K)){
	if(preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\/\>/isU',$site->body)){
		$site->body = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$site->body);
	}else{
		$site->body .= '<meta name="keywords" content="....." />';
		$site->body = preg_replace('/<meta name="keywords.*\/\>/isU','<meta name="keywords" content="'.$K.'" />',$site->body); 
	}
	unset($K);
	}
}
if($GetSimpleCMS){ // GetSimple CMS

	if(isset($T)&&trim($T)!='') $title = $T; else $title = '';
	if(isset($D)&&trim($D)!='') $metad = $description = $D; else $metad = $description = '';
	if(isset($K)&&trim($K)!='') $keywords = $K; else $keywords = '';
}
if($AbanteCMS){ // Abante CMS

	if(isset($T)&&trim($T)!='') $title = $T;
	if(isset($D)&&trim($D)!='') $description = $D;
	if(isset($K)&&trim($K)!='') $keywords = $K;
}
if($VamShop){ // VamShop CMS

	if(isset($T)&&trim($T)!='') $titleV = $T;
	if(isset($D)&&trim($D)!='') $descriptionV = $D;
	if(isset($K)&&trim($K)!='') $keywordsV = $K;
}
if($DLE){ // Data Life Engine (DLE)

	if(isset($T) && trim($T) != ''){$metatags['title'] = $T; unset($T);}
	if(isset($D) && trim($D) != ''){$metatags['description'] = $D; unset($D);}
	if(isset($K) && trim($K) != ''){$metatags['keywords'] = $K; unset($K);}
}
if($MODXEvolution){ // MODx Evolution

	$P = $this->documentOutput;
	if(isset($T)&&trim($T)!='') $P=preg_replace('/\<\s*title\s*\>.*\<\s*\/title\s*\>/isU','<title>'.$T.'</title>',$P);
	
	if(isset($D)){
	if(trim($D)!='' && preg_match('/\<\s*meta\s+name\s*=\s*"description.*\>/isU',$P)) 
	$P=preg_replace('/\<\s*meta\s+name\s*=\s*"description.*\>/isU','<meta name="description" content="'.$D.'" />',$P); 
	unset($D);
	}
 	if(isset($K)){
	if(trim($K)!='' && preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU',$P)) 
	$P=preg_replace('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU','<meta name="keywords" content="'.$K.'" />',$P); 
	unset($K);
	} 
	$this->documentOutput = $P; unset($P);
}
if($MODXRevolution){ // MODx Revolution
	
	$m = array('META_T'=>'', 'META_D'=>'', 'META_K'=>'');
	if(isset($T)&&trim($T)!=''){$m['META_T']=$T;unset($T);}
	if(isset($D)&&trim($D)!=''){$m['META_D']=$D;unset($D);}
	if(isset($K)&&trim($K)!=''){$m['META_K']=$K;unset($K);}

}
if($Prestashop){ // Prestashop
	
	if(!empty($T)) $meta_tags['meta_title'] = $T;
	if(!empty($D)) $meta_tags['meta_description'] = $D;
	if(!empty($K)) $meta_tags['meta_keywords'] = $K;

}
if($UMICMS){ // UMI CMS

  if(!empty($T)) $aSEOData['title'] = $T;
  if(!empty($D)) $aSEOData['descr'] = $D;
  if(!empty($K)) $aSEOData['keywr'] = $K;
  
}
if($diafan){ // Diafan CMS

  if(!empty($T)) $metaTitle = $T;
  if(!empty($D)) $metaDesc = $D;
  if(!empty($K)) $metaKey = $K;
  
}
if($peredovik){ // Передовик

	if(isset($T) && trim($T)!='') $content['meta_title'] = $T;
	if(isset($D) && trim($D)!='') $content['meta_desc'] = $D;
	if(isset($K) && trim($K)!='') $content['meta_keys'] = $K;
  
}
if($netcat){ // NetCat

	if(isset($T)&&!empty($T)){$template_header=preg_replace('/\<\s*title\s*\>.*\<\s*\/title\s*\>/isU','<title>'.$T.'</title>', $template_header); unset($T);}
	if(isset($D)&&!empty($D)){
		if(preg_match('/\<\s*meta\s+name\s*=\s*"description.*\/\>/isU',$template_header)){
			$template_header = preg_replace('/\<\s*meta\s+name\s*=\s*"description.*\>/isU','<meta name="description" content="'.$D.'" />',$template_header);
		}else{
			$template_header = preg_replace('/\<\/s*title>/isU','</title>'.PHP_EOL.'<meta name="description" content="'.$D.'" />',$template_header);
		}
	unset($D);
	}
 	if(isset($K)&&!empty($K)){
		if(preg_match('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU',$template_header)){
			$template_header = preg_replace('/\<\s*meta\s+name\s*=\s*"keywords.*\>/isU','<meta name="keywords" content="'.$K.'" />',$template_header);
		}else{
			$template_header = preg_replace('/\<\/s*title>/isU','</title>'.PHP_EOL.'<meta name="keywords" content="'.$K.'" />',$template_header);
		}
	unset($K);
	}
  
}

if($other){

	if(!empty($T))	$metaTitle = '<title>'.$T.'</title>';
	if(!empty($D))	$metaDesc = '<meta name="description" content="'.$D.'" />';
	if(!empty($K))	$metaKey = '<meta name="keywords" content="'.$K.'" />';

}

?>