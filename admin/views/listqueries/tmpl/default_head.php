<?php
defined('_JEXEC') or die('Restricted Access');
//checkAll is javasciript of joomla core
?>
<tr>
	<th width="5">
		<?php echo JText::_('COM_AURORA_SEARCH_QUERY_ID'); ?>
	</th>
	<th width="20">
		<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
	</th>			
	<th>
		<?php echo JText::_('COM_AURORA_SEARCH_QUERY_TEXT'); ?>
	</th>
</tr>


