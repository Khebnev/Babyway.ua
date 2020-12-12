<?php
// No direct access
defined( '_JEXEC' ) or die;

class plgSystemRedirect_VirtuemartInstallerScript
{

	function postflight( $type, $parent )
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery( true );
		$query->update( '#__extensions' )->set( 'enabled=1' )->where( 'type=' . $db->q( 'plugin' ) )->where( 'element=' . $db->q( 'redirect_virtuemart' ) );
		$db->setQuery( $query )->execute();

	}
}