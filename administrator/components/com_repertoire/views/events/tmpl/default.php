<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted Access');

$document = JFactory::getDocument();
$document->addStyleSheet('../media/com_repertoire/css/jquery.dataTables.css');
$document->addScript('../media/com_repertoire/js/jquery-1.10.2.min.js');
$document->addScript('../media/com_repertoire/js/jquery.dataTables.js');

JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

if (!empty($this->sidebar)) :
    ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
        <div id="j-main-container">
        <?php endif; ?>
        <form action="<?php echo JRoute::_('index.php?option=com_repertoire&view=events'); ?>" method="post" name="adminForm" id="adminForm">   
            <table id="repertoire-list" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th width="1%" align="center"><?php echo JHtml::_('grid.checkall'); ?></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_EVENT_DATE'); ?></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_EVENT_NAME'); ?></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_EVENT_PASS'); ?></th>
                        <th><?php echo JText::_('COM_REPERTOIRE_EVENT_SONGS_LIST'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->rows as $i => $row) :
                        $link = JRoute::_('index.php?option=com_repertoire&task=event.edit&id=' . $row->id);
                        $linklist = JRoute::_('index.php?option=com_repertoire&view=events&layout=list&id=' . $row->id);
                        ?>
                        <tr>
                            <td class="nowrap center hidden-phone"><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                            <td><a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REPERTOIRE_EDIT'); ?>"><?php echo $row->date; ?></a></td>
                            <td><a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_REPERTOIRE_EDIT'); ?>"><?php echo $row->name; ?></a></td>
                            <td><?php echo $row->pass; ?></td>
                            <td>
                                <?php if ($row->songs || $row->info): ?>
                                    <a href="<?php echo $linklist; ?>"><?php echo JText::_('COM_REPERTOIRE_EVENT_SONGS_LIST_LINK'); ?></a>
                                <?php endif; ?>
                            </td>
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
        "bPaginate": false, // wyłączone bo coś nie działa
        "bLengthChange": false, //"iDisplayLength": 50
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0] // wyłączenie sortowania dla tych kolumn
            }]
    });
    table.fnSort([[1, 'asc']]); // sortowanie wg daty
    $('#toolbar button:eq(3)').attr('onClick', null).off('click');
    $('#toolbar button:eq(3)').click(function(){
        if (confirm('<?php echo JText::_('COM_REPERTOIRE_CONFIRM_DELETE_OLD'); ?>')){
            Joomla.submitbutton('events.deleteold');
        }
    })
</script>