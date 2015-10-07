<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
    <div id="j-main-container">
        <table id="repertoire-list" class="table table-bordered table-hover dataTable">
            <thead>
                <tr>
                    
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
        <input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
    </div>
</form>
