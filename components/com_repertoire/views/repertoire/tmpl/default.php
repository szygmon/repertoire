<?php
// No direct access to this file
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
        <?php
        foreach ($this->rows as $row) :
            $search = $row->title.'+'.$row->artist;
            $ytlink = $row->youtube == '' ? 'https://www.youtube.com/results?search_query=' . str_replace(' ', '+', $search) : $row->youtube;
            ?>
            <tr>
                <td><?php echo $row->title; ?></td>
                <td><?php echo $row->artist; ?></td>
                <td><?php echo $row->language; ?></td>
                <td><?php echo $row->category; ?></td>
                <td class="center" style="padding: 7px;"><a href="<?php echo $ytlink; ?>" target="_blank"><img src="<?php echo $replink; ?>/images/yt.png" /></a></td>
                <td><?php echo $row->demo; ?></td>
            </tr>
        <?php endforeach; ?>
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
                'aTargets': [4, 5] // wyłączenie sortowania dla tych kolumn
            }]
    });
</script>