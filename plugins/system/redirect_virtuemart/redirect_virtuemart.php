<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Redirect_Virtuemart
 * @since       2.5+
 * @author		Vladimir Egorov
 */
class plgSystemRedirect_Virtuemart extends JPlugin
{
	
	protected $app;
	
	/**
	 * Class Constructor
	 * @param object $subject
	 * @param array $config
	 */
	public function __construct( & $subject, $config )
	{
		parent::__construct( $subject, $config );
		$this->loadLanguage();
	}

	function onAfterRender(){ 
		
		
		
		$article_id = $this->params->get('menu_id');

		//return;
		
		if (!$this->app->isSite() || !$article_id)
		{
			return;
		}
		
		$db = JFactory::getDbo();
		
		$uri = JURI::getInstance();
		$appsite = JFactory::getApplication('site');
		
		$router = $appsite->getRouter();
		$getParams = $router->parse($uri);
		
		// echo '<pre>'; print_r ($getParams); echo '</pre>';
		

		
		$keyword = $getParams['keyword'];
		$search = $getParams['search'];
		$limit = $getParams['limit'];
		$limitstart = $getParams['limitstart'];
		$view = $getParams['view'];
		$option = $getParams['option'];
		$Itemid_input = $getParams['Itemid'];
		$virtuemart_category_id = $getParams['virtuemart_category_id'];
		$layout = $getParams['layout'];
		
		if ($option == 'com_users') {
			return;
		}
		
		
		
		if ($keyword || $search == true || ($limit && $limit != 'int') || $limitstart) {
		
			return;
			
		}
		
		$main_url = 'index.php?option='.$option.'&view='.$view;
		

		
		if ($option == 'com_virtuemart') {
			unset($getParams['categorylayout']);
			unset($getParams['showcategory']);
			unset($getParams['showproducts']);
			unset($getParams['productsublayout']);
			unset($getParams['limit']);
			unset($getParams['limitstart']);
			
			if ($getParams['layout'] != 'tos' && $getParams['layout'] != 'contact') {
				unset($getParams['layout']);
			}
			
		}
		
		
		if ($option == 'com_virtuemart' && $view == 'category' && $getParams['virtuemart_manufacturer_id'] < 1) {
			
			unset($getParams['virtuemart_manufacturer_id']);
			
		}
		
		if ($option == 'com_virtuemart' && $view == 'manufacturer') {

			
		}
		
		//// Если категории нет в запросе
		
		if ($view == 'productdetails' && !$getParams['virtuemart_category_id']) {
			
			$db->setQuery(
						'SELECT virtuemart_category_id FROM #__virtuemart_product_categories WHERE virtuemart_product_id = "'.$getParams['virtuemart_product_id'].'"'
		);
			
			$result = $db->loadResult();
			
			$getParams['virtuemart_category_id'] = $result;
			
		}
		
		if ((int)$getParams['virtuemart_manufacturer_id'] > 0) {
			unset($getParams['virtuemart_category_id']);
		}
		
		
		// echo '<pre>'; print_r ($getParams); echo '</pre>';
		
		$url_add = '';
		
		unset($getParams['format']);
		unset($getParams['Itemid']);
		unset($getParams['option']);
		unset($getParams['view']);
		
		foreach ($getParams as $key => $value) {
			$url_add .= '&'.$key.'='.$value;
		}
		if ($Itemid_input) {
			$url_add .= '&Itemid='.$Itemid_input;
		}
		
		$main_url = $main_url.$url_add;
		
		// echo $main_url; // собранная ссылка не sef
		
		$main_url_sefurl = JRoute::_($main_url, FALSE);
		
		$main_url_sefurl = explode('?', $main_url_sefurl);
		
		$main_url_sefurl = $main_url_sefurl[0];
		
		
		// echo '<br>'.$main_url_sefurl; // cформированная sef ссылка плагином
		
		$uri = JFactory::getURI();

		$url = $uri->toString(array('path', 'query', 'fragment'));
		$url = DIRECTORY_SEPARATOR.$url;
		
		$url = explode('?', $url);
		
		$url = $url [0];
		
		
		// echo '<br>'.$url; // сформированная ссылка полученная из адресной строки
		
		/////////////////////////////////////////////////////////
		//Получаем либо меню либо адрес статьи, куда будет редирект
		/////////////////////////////////////////////////////////
		
		$article_url = 'index.php?option=com_content&view=article&id=' . $article_id;
		
		$db->setQuery(
						'SELECT id FROM #__menu WHERE link = "'.$article_url.'"'
		);
		
		$result = $db->loadResult();
		
		if ($result) {
			$article_url = JRoute::_('index.php?option=com_content&view=article&id=' . $article_id.'&Itemid='.$result);
		} else {
			$article_url = JRoute::_('index.php?option=com_content&view=article&id=' . $article_id);
		}
		
		if ($option == 'com_virtuemart' && $view == 'manufacturer' && $url != $main_url_sefurl) {
			$this->app->redirect($main_url_sefurl);
		}
		if ($option == 'com_virtuemart' && $view == 'category' && !$getParams['virtuemart_manufacturer_id'] && $url != $main_url_sefurl) {
			$this->app->redirect($main_url_sefurl);
		}
		
		if ($option == 'com_virtuemart' && $view == 'orders' && $url != $main_url_sefurl) {
			$this->app->redirect($main_url_sefurl);
		}

		if ($url != $main_url_sefurl) {
			$this->app->redirect($article_url);
		}
		
		
		
				
	}
	
	

}
