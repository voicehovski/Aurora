<?php
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
	<tr class="row<?php echo $i % 2; ?>">
	<td></td><td></td><td></td>
		<!-- Some list data in columns, for expample $item->id $item->content. Usefull is JHTML::_() -->
	</tr>
<?php endforeach; ?>