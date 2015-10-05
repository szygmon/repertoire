<?php
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
<form action="index.php" method="post" name="adminForm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%" align="center"><input type="checkbox" name="checkall-toggle" value="" class="hasTooltip" title="" onclick="Joomla.checkAll(this)" data-original-title="Zaznacz wszystko" /></th>
                <th><a href="#" onclick="return false;" class="js-stools-column-order hasTooltip" data-order="a.title" data-direction="ASC" data-name="Tytuł" title="" data-original-title="<strong>Tytuł</strong><br />Przyciśnij, by sortować według tej kolumny."><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></a></th>
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
</form>