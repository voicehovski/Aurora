<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<h1><?php JText::_ ( 'COM_AURORA_SEARCH_TEST_HEADER' ); ?></h1>
<h2><?php echo $this->rp; ?></h2>
<h2><?php echo $this->dbp; ?></h2>
<h2><?php echo $this->pkw; ?></h2>

<?php
foreach ( $this->products as $productItem ) {
	echo "<div class='product-list-item'>$productItem</div>";
}
?>
