<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link https://virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 9942 2018-09-27 11:54:06Z junstoppable $
 */

defined ('_JEXEC') or die('Restricted access');

if (vRequest::getInt('dynamic',false) and vRequest::getInt('virtuemart_product_id',false)) {
	if (!empty($this->products)) {
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

		echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	}

	return ;
}
?> <div class="category-view"> <?php
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";
vmJsApi::addJScript('vm-hover',$js);

?><h1><?php echo vmText::_($this->category->category_name); ?></h1>


<?php
if ($this->show_store_desc and !empty($this->vendor->vendor_store_desc)) { ?>
	<div class="vendor-store-desc">
		<?php echo $this->vendor->vendor_store_desc; ?>
	</div>
<?php }

if (!empty($this->showcategory_desc) and empty($this->keyword)){
	if(!empty($this->category)) {
	?>

<?php  

$pos = strpos($_SERVER['REQUEST_URI'], "start");

if ($pos === false) {

$desc = explode('<hr id="system-readmore" />', $this->category->category_description);
if($desc[1]){ ?>
    <div class="category_description description_top"><?php echo $desc[0]; ?></div>                    
<?php } else { ?>
<div class="category_description">    
    <?php echo $this->category->category_description; ?>    
</div>
<?php }  

} ?>

<?php  

$pos1 = strpos($_SERVER['REQUEST_URI'], "start=0");

if ($pos1 > 0) {

$desc = explode('<hr id="system-readmore" />', $this->category->category_description);
if($desc[1]){ ?>
    <div class="category_description description_top"><?php echo $desc[0]; ?></div>                    
<?php } else { ?>
<div class="category_description">    
    <?php echo $this->category->category_description; ?>    
</div>
<?php }  

}
 ?>





<?php }
	if(!empty($this->manu_descr)) {
		?>
        <div class="manufacturer-description">
			<?php echo $this->manu_descr; ?>
        </div>
	<?php }
}

// Show child categories
if ($this->showcategory and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) {
		echo ShopFunctionsF::renderVmSubLayout('categories',array('categories'=>$this->category->children, 'categories_per_row'=>$this->categories_per_row));
	}
}

if (!empty($this->products) or ($this->showsearch or $this->keyword !== false)) {
?>
<div class="browse-view">
<?php

if ($this->showsearch or $this->keyword !== false) {
	//id taken in the view.html.php could be modified
	$category_id  = vRequest::getInt ('virtuemart_category_id', 0); ?>

	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">
			<?php if(!empty($this->searchCustomList)) { ?>
			<div class="vm-search-custom-list">
				<?php echo $this->searchCustomList ?>
			</div>
			<?php } ?>

			<?php if(!empty($this->searchCustomValues)) { ?>
			<div class="vm-search-custom-values">
				<?php
                echo ShopFunctionsF::renderVmSubLayoutAsGrid(
                    'searchcustomvalues',
                    array (
                        'searchcustomvalues' => $this->searchCustomValues,
                        'options' => array (
                            'items_per_row' => array (
                                'xs' => 2,
                                'sm' => 2,
                                'md' => 2,
                                'lg' => 2,
                                'xl' => 2,
                            ),
                        ),
                    )
                );
                ?>
			</div>
			<?php } ?>
			<?php if (strrpos($_SERVER["REQUEST_URI"], "keyword") !== false) {?>

			<div class="vm-search-custom-search-input">
				<input name="keyword" class="inputbox" type="text" size="40" value="<?php echo $this->keyword ?>"/>
				<input type="submit" value="<?php echo vmText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
				<?php //echo VmHtml::checkbox ('searchAllCats', (int)$this->searchAllCats, 1, 0, 'class="changeSendForm"'); ?>
				<span class="vm-search-descr"> <?php echo vmText::_('COM_VM_SEARCH_DESC') ?></span>
			</div>

			<?php } ?>

			<!-- input type="hidden" name="showsearch" value="true"/ -->
			<input type="hidden" name="view" value="category"/>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>
			<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>"/>
		</form>
	</div>
	<!-- End Search Box -->
<?php
	/*if($this->keyword !== false){
		?><h3><?php echo vmText::sprintf('COM_VM_SEARCH_KEYWORD_FOR', $this->keyword); ?></h3><?php
	}*/
	$j = 'jQuery(document).ready(function() {

jQuery(".changeSendForm")
	.off("change",Virtuemart.sendCurrForm)
    .on("change",Virtuemart.sendCurrForm);
})';

	vmJsApi::addJScript('sendFormChange',$j);
} ?>

<?php // Show child categories

if(!empty($this->orderByList)) { ?>
<div class="orderby-displaynumber">
	<div class="floatleft vm-order-list">
		<?php echo $this->orderByList['orderby']; ?>
		<?php echo $this->orderByList['manufacturer']; ?>
	</div>
	<div class="vm-pagination vm-pagination-top">
		<?php echo $this->vmPagination->getPagesLinks (); ?>
		<span class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></span>
	</div>
	<div class="floatright display-number"><?php echo $this->vmPagination->getResultsCounter ();?><br/><?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?></div>

	<div class="clear"></div>
</div> <!-- end of orderby-displaynumber -->
<?php } ?>




<?php if (!empty($this->category->category_name)) { ?>

<?php } ?>

	<?php
	if (!empty($this->products)) {
		//revert of the fallback in the view.html.php, will be removed vm3.2
		if($this->fallback){
			$p = $this->products;
			$this->products = array();
			$this->products[0] = $p;
			vmdebug('Refallback');
		}

	echo shopFunctionsF::renderVmSubLayout($this->productsLayout,array('products'=>$this->products,'currency'=>$this->currency,'products_per_row'=>$this->perRow,'showRating'=>$this->showRating));

	if(!empty($this->orderByList)) { ?>
		<div class="vm-pagination vm-pagination-bottom" style="float: none !important;"><?php echo $this->vmPagination->getPagesLinks (); ?><span class="vm-page-counter"><?php echo $this->vmPagination->getPagesCounter (); ?></span></div>
	<?php }
} elseif ($this->keyword !== false) {
	echo vmText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div>

<?php } ?>


<?php  

$pos = strpos($_SERVER['REQUEST_URI'], "start");
if ($pos === false) {



 if($desc[1]){ ?>

 <div style="clear: both;"></div>
        <div class="category_description description_bottom"><?php echo $desc[1]; ?></div>
<?php 
	} 
} 
?>

<?php  

$pos1 = strpos($_SERVER['REQUEST_URI'], "start=0");
if ($pos1 > 0) {



 if($desc[1]){ ?>

 <div style="clear: both;"></div>
        <div class="category_description description_bottom"><?php echo $desc[1]; ?></div>
<?php 
	} 
} 
?>




</div>

<?php
if(VmConfig::get ('ajax_category', false)){
	$j = "Virtuemart.container = jQuery('.category-view');
	Virtuemart.containerSelector = '.category-view';";

	vmJsApi::addJScript('ajax_category',$j);
	vmJsApi::jDynUpdate();
}
?>
<!-- end browse-view -->


