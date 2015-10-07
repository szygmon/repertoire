<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript('../components/com_repertoire/js/jquery.dataTables.js');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>

<?php if (!empty($this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
        <div id="j-main-container">
        <?php endif; ?>
        <form action="<?php echo JRoute::_('index.php?option=com_repertoire'); ?>" method="post" name="adminForm" id="adminForm">   
            <table id="repertoire-list" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th width="1%" align="center"><?php echo JHtml::_('grid.checkall'); ?></th>
                        <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="<?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?>" title="" data-original-title="<strong><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></strong><br /><?php echo JText::_('JGLOBAL_CLICK_TO_SORT_THIS_COLUMN'); ?>"><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></a></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->rows as $row) :
                        $link = JRoute::_('index.php?option=com_repertoire&task=song.edit&id=' . $row->id);
                        ?>
                        <tr>
                            <td class="nowrap center hidden-phone"><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                            <td><a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REPERTOIRE_EDIT'); ?>"><?php echo $row->name; ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <?php echo JHtml::_('form.token'); ?>
    </div>
</form>

<script type="text/javascript">
    var table = $('#repertoire-list').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0] // wyłączenie sortowania dla tych kolumn
            }]
    });
    table.fnSort( [ [1,'asc'] ] ); // sortowanie wg tytułu
</script>