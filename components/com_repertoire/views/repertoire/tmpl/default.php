<?php
defined('_JEXEC') or die('Restricted access');

$replink = str_replace(JPATH_SITE, '', JPATH_COMPONENT);
$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript($replink . '/js/jquery.dataTables.js');
?>

<h1><?php echo $this->greeting; ?></h1>
<table id="repertoire-list" class="table table-bordered table-hover dataTable">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></th>
            <th><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></th>
            <th><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></th>
            <th><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></th>
            <th><?php echo JText::_('COM_REPERTOIRE_YOUTUBE'); ?></th>
            <th><?php echo JText::_('COM_REPERTOIRE_DEMO'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < $this->count; $i++) { ?>
            <tr>
                <td><?php echo $this->rows[$i]->rep_title; ?></td>
                <td><?php echo $this->rows[$i]->rep_artist; ?></td>
                <td><?php echo $this->rows[$i]->rep_language; ?></td>
                <td><?php echo $this->rows[$i]->rep_category; ?></td>
                <td><?php echo $this->rows[$i]->rep_youtube; ?></td>
                <td><?php echo $this->rows[$i]->rep_demo; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

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
                'aTargets': [4,5] // wyłączenie sortowania dla tych kolumn
            }]
    });
</script>