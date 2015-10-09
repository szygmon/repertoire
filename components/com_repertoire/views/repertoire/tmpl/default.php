<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$replink = str_replace(JPATH_SITE, '', JPATH_COMPONENT);
$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript($replink . '/js/jquery.dataTables.js');

$span = $this->params->get('show_demo', 1) ? 'rowspan="2"' : '';
?>

<?php if ($this->params->get('pre_text', NULL))
    echo $this->params->get('pre_text');
?>
<table id="repertoire-list" class="table table-bordered table-hover dataTable">
    <thead>
        <tr>
            <th <?php echo $span; ?> width="35%"><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></th>
            <th <?php echo $span; ?> width="20%"><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></th>
            <th <?php echo $span; ?> width="5%"><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></th>
            <?php if ($this->params->get('show_category', 1)): ?>
                <th <?php echo $span; ?> width="15%"><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></th>
            <?php endif; ?>
            <?php if ($this->params->get('show_demo', 1)): ?>
                <th colspan="2" class="center"><?php echo JText::_('COM_REPERTOIRE_DEMO'); ?></th>
        <?php endif; ?>
        </tr>
<?php if ($this->params->get('show_demo', 1)): ?>
            <tr>
                <th class="center" width="20%"><?php echo JText::_('COM_REPERTOIRE_DEMO_AUDIO'); ?></th>
                <th class="center" width="5%"><?php echo JText::_('COM_REPERTOIRE_DEMO_VIDEO'); ?></th>
            </tr>
<?php endif; ?>
    </thead>
    <tbody>
        <?php
        foreach ($this->rows as $row) :
            $search = $row->title . '+' . $row->artist;
            //$ytlink = $row->youtube == '' ? 'https://www.youtube.com/results?search_query=' . str_replace(' ', '+', $search) : $row->youtube;
            $ytlink = 'https://www.youtube.com/results?search_query=' . str_replace(' ', '+', $search);
            ?>
            <tr>
                <td>
                    <?php if (date("Y-m-d", strtotime("-1 month")) < $row->date): ?>
                        <img src="<?php echo $replink; ?>/images/new.png" />
    <?php endif ?>
                    <a href="<?php echo $ytlink; ?>" target="_blank"><?php echo $row->title; ?></a>
                </td>
                <td><?php echo $row->artist; ?></td>
                <td><?php echo $row->language; ?></td>
                <?php if ($this->params->get('show_category', 1)): ?>
                    <td><?php echo $row->category; ?></td>
                <?php endif; ?>
                    <?php if ($this->params->get('show_demo', 1)): ?>
                    <td>
        <?php if ($row->demo_audio): ?>
                            <object type="application/x-shockwave-flash" data="plugins/content/josdewplayer/dewplayer.swf" width="200" height="20" id="dewplayer" name="dewplayer">
                                <param name="wmode" value="transparent">
                                <param name="movie" value="plugins/content/josdewplayer/dewplayer.swf">
                                <param name="flashvars" value="mp3=images/demomp3/<?php echo $row->demo_audio; ?>&amp;autostart=0&amp;autoreplay=0&amp;showtime=1">
                            </object>
        <?php endif ?>
                    </td>
                    <td class="center" style="padding: 7px;">
                        <?php if ($row->demo_video): ?>
                            <a href="<?php echo $row->demo_video; ?>" target="_blank"><img src="<?php echo $replink; ?>/images/yt.png" /></a>
                    <?php endif ?>
                    </td>
            <?php endif; ?>
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
        "iDisplayLength": <?php echo $this->params->get('positions', 100); ?>
    });
</script>

<?php
if ($this->params->get('post_text', NULL))
    echo $this->params->get('post_text');?>