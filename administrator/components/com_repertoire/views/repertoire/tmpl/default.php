<?php
defined('_JEXEC') or die;

$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript('../components/com_repertoire/js/jquery.dataTables.js');


//JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="span10">
<?php else : ?>
            <div id="j-main-container">
        <?php endif; ?>
            <table id="repertoire-list" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th width="1%" align="center"><input type="checkbox" name="checkall-toggle" value="" class="hasTooltip" title="" onclick="Joomla.checkAll(this)" data-original-title="Zaznacz wszystko" /></th>
                        <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="<?php echo JText::_('COM_REPERTOIRE_TITLE'); ?>" title="" data-original-title="<strong><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></strong><br /><?php echo JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN'); ?>"><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></a></th>
                        <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="<?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?>" title="" data-original-title="<strong><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></strong><br /><?php echo JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN'); ?>"><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></a></th>
                        <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="<?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?>" title="" data-original-title="<strong><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></strong><br /><?php echo JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN'); ?>"><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></a></th>
                        <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="<?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?>" title="" data-original-title="<strong><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></strong><br /><?php echo JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN'); ?>"><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></a></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_YOUTUBE'); ?></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_DEMO'); ?></th>
                    </tr>
                </thead>
                <tbody>
<?php for ($i = 0; $i < $this->count; $i++) { ?>
                        <tr>
                            <td><?php echo JHtml::_('grid.id', $i, $this->zastepstwa[$i]->rep_id); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_title); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_artist); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_language); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_category); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_youtube); ?></td>
                            <td><?php echo JHTML::_('link', 'index.php?option=com_zast&view=edit&zastid=' . $this->zastepstwa[$i]->rep_id, $this->rows[$i]->rep_demo); ?></td>
                        </tr>
<?php } ?>
                </tbody>
            </table>
            <input type="hidden" name="option" value="com_zast" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
        </div>
</form>

<script type="text/javascript">
    $('#repertoire-list').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0,5,6] // wyłączenie sortowania dla tych kolumn
            }]
    });
</script>