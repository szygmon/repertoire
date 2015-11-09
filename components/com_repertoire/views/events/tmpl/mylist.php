<?php
// Brak bezpośredniego dostępu do pliku
defined('_JEXEC') or die('Restricted access');

$replink = str_replace(JPATH_SITE, '', JPATH_COMPONENT);
$document = JFactory::getDocument();
$document->addStyleSheet('http://cdn.datatables.net/1.10.9/css/jquery.dataTables.css');
$document->addScript('http://code.jquery.com/jquery-1.10.2.min.js');
$document->addScript('components/com_repertoire/js/jquery.dataTables.js');

$span = $this->params->get('show_demo', 1) ? 'rowspan="2"' : '';
?>
<div class="row-fluid">
    <div class="span4"><h2><?php echo JText::_('COM_REPERTOIRE_EVENT_NAME'); ?></h2></div>
    <div class="span8"><h2><?php echo $this->event->name; ?></h2></div>
</div>
<div class="row-fluid">
    <div class="span4"><h3><?php echo JText::_('COM_REPERTOIRE_EVENT_DATE'); ?></h3></div>
    <div class="span8"><h3><?php echo $this->event->date; ?></h3></div>
</div>
<div class="row-fluid center"><h4>Dostępny repertuar</h4></div>
<form action="<?php echo JRoute::_('index.php?option=com_repertoire&view=events'); ?>" method="post" name="Form">
    <div class="row-fluid">
        <table id="repertoire-list"  class="table table-bordered table-hover dataTable">
            <thead>
                <tr>
                    <th <?php echo $span; ?> width="1%"></th>
                    <th <?php echo $span; ?> width="34%"><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></th>
                    <th <?php echo $span; ?> width="20%"><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></th>
                    <?php if ($this->params->get('show_language', 1)): ?>
                        <th <?php echo $span; ?> width="5%"><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></th>
                        <?php
                    endif;
                    if ($this->params->get('show_category', 1)):
                        ?>
                        <th <?php echo $span; ?> width="15%"><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></th>
                        <?php
                    endif;
                    if ($this->params->get('show_demo', 1)):
                        ?>
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
                foreach ($this->rows as $i => $row) :
                    $search = $row->title . '+' . $row->artist;
                    //$ytlink = $row->youtube == '' ? 'https://www.youtube.com/results?search_query=' . str_replace(' ', '+', $search) : $row->youtube;
                    $ytlink = 'https://www.youtube.com/results?search_query=' . str_replace(' ', '+', $search);
                    ?>
                    <tr>
                        <td class="center"><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                        <td>
                            <?php if ($this->params->get('show_news', 1) && date("Y-m-d", strtotime("-" . $this->params->get('news', 3) . " months")) < $row->date): ?>
                                <img src="<?php echo $replink; ?>/images/new.png" />
                            <?php endif; ?>
                            <a href="<?php echo $ytlink; ?>" target="_blank"><?php echo $row->title; ?></a>
                        </td>
                        <td><?php echo $row->artist; ?></td>
                        <?php if ($this->params->get('show_language', 1)): ?>
                            <td><?php echo $row->language; ?></td>
                            <?php
                        endif;
                        if ($this->params->get('show_category', 1)):
                            ?>
                            <td><?php echo $row->category; ?></td>
                            <?php
                        endif;
                        if ($this->params->get('show_demo', 1)):
                            ?>
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
    </div>
    <div class="height-10"></div>
    <div class="row-fluid center">
        <h4><?php echo JText::_('COM_REPERTOIRE_ADDITIONAL_INFO'); ?></h4>
    </div>
    <div class="row-fluid">
        <textarea name="info" style="width: 100%; height: 100px;"></textarea>
    </div>
    <div class="height-10"></div>
    <div class="row-fluid">
        <input type="submit" name="save" id="send_repertoire" value="<?php echo JText::_('COM_REPERTOIRE_SEND_REPERTOIRE'); ?>" class="btn btn-primary" />
        <input type="hidden" name="eventid" value="<?php echo JRequest::getVar('id'); ?>" />
        <input type="hidden" name="task" value="events.add" />
    </div>
</form>
<script type="text/javascript">
    var table = $('#repertoire-list').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false,
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0] // wyłączenie sortowania dla tych kolumn
            }]
    });
    table.fnSort([[1, 'asc']]); // sortowanie wg tytułu

    // reset szukajki przy wysyłaniu - zapobiega błędom
    $('#send_repertoire').click(function () {
        table.fnFilter('');
    });
</script>
