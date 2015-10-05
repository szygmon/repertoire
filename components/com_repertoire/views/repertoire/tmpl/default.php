<?php
// No direct access

defined('_JEXEC') or die('Restricted access');
JFactory::getLanguage()->load('com_repertoire');
?>

<h1><?php echo $this->greeting; ?></h1>
<table>
    <tr>
        <th><?php echo JText::_('COM_REPERTOIRE_TITLE'); ?></th>
        <th><?php echo JText::_('COM_REPERTOIRE_ARTIST'); ?></th>
        <th><?php echo JText::_('COM_REPERTOIRE_LANGUAGE'); ?></th>
        <th><?php echo JText::_('COM_REPERTOIRE_CATEGORY'); ?></th>
        <th><?php echo JText::_('COM_REPERTOIRE_YOUTUBE'); ?></th>
        <th><?php echo JText::_('COM_REPERTOIRE_DEMO'); ?></th>
    </tr>
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
</table>