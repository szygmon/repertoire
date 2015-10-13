<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted Access');

$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript('../components/com_repertoire/js/jquery.dataTables.js');

if (!empty($this->sidebar)) :
    ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
    <?php else : ?>
        <div id="j-main-container">
        <?php endif; ?>

        <h2><?php echo $this->rows[0]->date . ': ' . $this->rows[0]->name; ?></h2>
        <form action="<?php echo JRoute::_('index.php?option=com_repertoire&view=events'); ?>" method="post" name="adminForm" id="adminForm">   
            <table id="repertoire-list" class="table table-bordered table-hover dataTable">
                <thead>
                    <tr>
                        <th width="1%"><?php echo JText::_('COM_REPERTOIRE_COUNT'); ?></th>
                        <th width="44%"><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></th>
                        <th width="30%"><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></th>
                        <th width="5%"><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></th>
                        <th width="20%"><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->rows as $row) :
                        $link = JRoute::_('index.php?option=com_repertoire&task=song.edit&id=' . $row->id);
                        ?>
                        <tr>
                            <td><?php echo $row->count; ?></td>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->artist; ?></td>
                            <td><?php echo $row->language; ?></td>
                            <td><?php echo $row->category; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="id" value="<?php echo JRequest::getVar('id'); ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>

    <script type="text/javascript">
        var table = $('#repertoire-list').dataTable({
            "bPaginate": false, // wyłączone bo coś nie działa
            "bLengthChange": false, //"iDisplayLength": 50
            "bFilter": <?php echo $this->print ? 'false' : 'true'; ?>,
            "bSort": true,
            "bInfo": <?php echo $this->print ? 'false' : 'true'; ?>,
            "bAutoWidth": false
        });
        table.fnSort([[0, 'desc']]); // sortowanie wg tytułu
    </script>