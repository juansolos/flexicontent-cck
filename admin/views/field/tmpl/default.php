<?php
/**
 * @version 1.5 stable $Id: default.php 1125 2012-01-26 12:38:53Z ggppdk $
 * @package Joomla
 * @subpackage FLEXIcontent
 * @copyright (C) 2009 Emmanuel Danan - www.vistamedia.fr
 * @license GNU/GPL v2
 * 
 * FLEXIcontent is a derivative work of the excellent QuickFAQ component
 * @copyright (C) 2008 Christoph Lukes
 * see www.schlu.net for more information
 *
 * FLEXIcontent is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

defined('_JEXEC') or die('Restricted access');

$tip_class = FLEXI_J30GE ? ' hasTooltip' : ' hasTip';
$btn_class = FLEXI_J30GE ? 'btn' : 'fc_button fcsimple';
$infoimage 	= JHTML::image ( 'administrator/components/com_flexicontent/assets/images/lightbulb.png', JText::_( 'FLEXI_NOTES' ), ' style="vertical-align:top; margin-top:6px;" ' );
unset($form);
$form = & $this->form;

// Load JS tabber lib
$this->document->addScript(JURI::root(true).'/components/com_flexicontent/assets/js/tabber-minimized.js');
$this->document->addStyleSheet(JURI::root(true).'/components/com_flexicontent/assets/css/tabber.css');
$this->document->addScriptDeclaration(' document.write(\'<style type="text/css">.fctabber{display:none;}<\/style>\'); ');  // temporarily hide the tabbers until javascript runs
$js = "
	jQuery(document).ready(function(){
		fc_bind_form_togglers('flexicontent');
	});
";
$this->document->addScriptDeclaration($js);
?>

<div class="flexicontent" id="flexicontent">
<form action="index.php" method="post" class="form-validate" name="adminForm" id="adminForm">

<div class="container-fluid">

	<div class="span6 full_width_980">
	
		<!--span class="badge"><h3><?php echo JText::_( /*'FLEXI_STANDARD_FIELDS_PROPERTIES'*/'Common configuration' ); ?></h3></span-->
		
		<table class="fc-form-tbl" style="margin-bottom:12px;">
			<tr>
				<td class="key">
					<?php echo $form->getLabel('label'); ?>
				</td>
				<td>
					<?php echo $form->getInput('label'); ?>
				</td>
			</tr>
			<?php if ($form->getValue('iscore') == 0) : ?>
			<tr>
				<td class="key">
					<?php echo $form->getLabel('name'); ?>
				</td>
				<td>
					<?php echo $form->getInput('name'); ?>
				</td>
			</tr>
			<?php else : ?>
			<tr>
				<td class="key">
					<?php echo $form->getLabel('name'); ?>
				</td>
				<td>
					<?php echo $form->getValue("name"); ?>
				</td>
			</tr>
			<?php endif; ?>

			
			<?php if ($form->getValue("iscore") == 0) : ?>
			<tr>
				<td class="key">
				<?php echo $form->getLabel('field_type'); ?>
				</td>
				<td>
				<?php echo $this->lists['field_type']; ?>
				&nbsp;&nbsp;&nbsp;
				[ <span id="field_typename"><?php echo $form->getValue('field_type'); ?></span> ]
				</td>
			</tr>
			<?php endif; ?>

		</table>
		
		<div class="fctabber fields_tabset" id="field_specific_props_tabset">
			
			<div class="tabbertab" id="fcform_tabset_common_basic_tab" data-icon-class="icon-home-2" >
				<h3 class="tabberheading"> <?php echo JText::_( 'FLEXI_BASIC' ); ?> </h3>
				
				<table class="fc-form-tbl">
					<tr>
						<td class="key">
							<?php echo $form->getLabel('published'); ?>
						</td>
						<td>
							<?php echo $form->getInput('published'); ?>
							<?php
							$disabled = ($form->getValue("id") > 0 && $form->getValue("id") < 7);
							if ($disabled) {
								$this->document->addScriptDeclaration("
									jQuery( document ).ready(function() {
										setTimeout(function(){ 
											jQuery('#jform_published input').attr('disabled', 'disabled').off('click');
											jQuery('#jform_published label').attr('disabled', true).off('click');
										}, 1);
									});
								");
							}
							?>
						</td>
					</tr>
					
					<tr>
						<td class="key">
							<?php echo $form->getLabel('access'); ?>
						</td>
						<td>
							<?php echo $form->getInput('access'); ?>
						</td>
					</tr>
					
					<tr>
						<td class="key">
							<?php echo $form->getLabel('ordering'); ?>
						</td>
						<td>
							<?php echo $form->getInput('ordering'); ?>
						</td>
					</tr>
					
					<tr>
						<td colspan="2" style="padding-top:24px;">
							<?php $box_class = $this->row->iscore ? 'fc-info' : ($this->typesselected ? 'fc-success' : 'fc-warning'); ?>
							<span class="<?php echo $box_class; ?> fc-mssg" style="width:90%; margin:6px 0px 0px 0px !important;">
								<?php echo JText::_( $this->row->iscore ? 'FLEXI_SELECT_TYPES_CORE_NOTES' : 'FLEXI_SELECT_TYPES_CUSTOM_NOTES' ); ?>
							</span>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span class="label label-warning" style="vertical-align:middle;">
								<?php echo JText::_( 'FLEXI_TYPES' ); ?>
							</span>
							<?php echo /*FLEXI_J16GE ? $form->getInput('tid') :*/ $this->lists['tid']; ?>
						</td>
					</tr>
					
				</table>
			</div>
			
			
			<div class="tabbertab" id="fcform_tabset_common_basic_tab" data-icon-class="icon-pencil" >
				<h3 class="tabberheading"> <?php echo JText::_( 'FLEXI_ITEM_FORM' ); ?> </h3>
				<table class="fc-form-tbl">
					
					<tr<?php echo !$this->supportuntranslatable?' style="display:none;"':'';?>>
						<td class="key">
							<?php echo $form->getLabel('untranslatable'); ?>
						</td>
						<td>
							<?php echo $form->getInput('untranslatable'); ?>
						</td>
					</tr>
	
					<tr<?php echo !$this->supportformhidden?' style="display:none;"':'';?>>
						<td class="key">
							<?php echo $form->getLabel('formhidden'); ?>
						</td>
						<td>
							<?php echo $form->getInput('formhidden'); ?>
						</td>
					</tr>
					
					<tr<?php echo !$this->supportvalueseditable?' style="display:none;"':'';?>>
						<td class="key">
							<?php echo $form->getLabel('valueseditable'); ?>
						</td>
						<td>
							<?php echo $form->getInput('valueseditable'); ?>
						</td>
					</tr>
					
					<tr<?php echo !$this->supportedithelp?' style="display:none;"':'';?>>
						<td class="key">
							<?php echo $form->getLabel('edithelp'); ?>
						</td>
						<td>
							<?php echo $form->getInput('edithelp'); ?>
						</td>
					</tr>
					
					<tr>
						<td class="key">
							<?php echo $form->getLabel('description'); ?>
						</td>
						<td>
							<?php echo $form->getInput('description'); ?>
						</td>
					</tr>
					
				</table>
			</div>
			
			
			<?php if ($this->supportsearch || $this->supportfilter || $this->supportadvsearch || $this->supportadvfilter) : ?>
			<div class="tabbertab" id="fcform_tabset_common_basic_tab" data-icon-class="icon-search" >
				<h3 class="tabberheading"> <?php echo JText::_( 'FLEXI_FIELD_SEARCH_FILTERING' ); ?> </h3>
				
				<?php if ($this->supportsearch || $this->supportfilter) : ?>
					<span class="fcsep_level1" style="width:90%; margin-top:16px;"><?php echo JText::_( 'FLEXI_BASIC_INDEX' ); ?></span>
					<span class="fcsep_level4" style="margin-left: 32px;"><?php echo JText::_( 'FLEXI_BASIC_INDEX_NOTES' ); ?></span>
					<div class="fcclear"></div>
				
					<table class="fc-form-tbl">
						<?php if ($this->supportsearch) : ?>
						<tr>
							<td class="key">
								<?php echo $form->getLabel('issearch'); ?>
							</td>
							<td>
								<?php echo
									in_array($form->getValue('issearch'),array(-1,2)) ?
										JText::_($form->getValue('issearch')==-1 ? 'FLEXI_NO' : 'FLEXI_YES') .' -- '. JText::_('FLEXI_FIELD_BASIC_INDEX_PROPERTY_DIRTY') :
										$form->getInput('issearch'); ?>
							</td>
						</tr>
						<?php endif; ?>
						
						<?php if ($this->supportfilter) : ?>
						<tr>
							<td class="key">
								<?php echo $form->getLabel('isfilter'); ?>
							</td>
							<td>
								<?php echo $form->getInput('isfilter'); ?>
							</td>
						</tr>
						<?php endif; ?>
					</table>
				<?php endif; ?>
				
				
				<?php if ($this->supportadvsearch || $this->supportadvfilter) : ?>
					<span class="fcsep_level1" style="width:90%; margin-top:16px; "><?php echo JText::_( 'FLEXI_ADV_INDEX' ); ?></span>
					<span class="fcsep_level4" style="margin-left: 32px;"><?php echo JText::_( 'FLEXI_ADV_INDEX_NOTES' ); ?></span>
					<div class="fcclear"></div>
					
					<table class="fc-form-tbl">
						<?php if ($this->supportadvsearch) : ?>
						<tr>
							<td class="key">
								<?php echo $form->getLabel('isadvsearch'); ?>
							</td>
							<td>
								<?php echo
									in_array($form->getValue('isadvsearch'),array(-1,2)) ?
										JText::_($form->getValue('isadvsearch')==-1 ? 'FLEXI_NO' : 'FLEXI_YES') .' -- '. JText::_('FLEXI_FIELD_ADVANCED_INDEX_PROPERTY_DIRTY') :
										$form->getInput('isadvsearch'); ?>
							</td>
						</tr>
						<?php endif; ?>
						
						<?php if ($this->supportadvfilter) : ?>
						<tr>
							<td class="key">
								<?php echo $form->getLabel('isadvfilter'); ?>
							</td>
							<td>
								<?php echo
									in_array($form->getValue('isadvfilter'),array(-1,2)) ?
										JText::_($form->getValue('isadvfilter')==-1 ? 'FLEXI_NO' : 'FLEXI_YES') .' -- '. JText::_('FLEXI_FIELD_ADVANCED_INDEX_PROPERTY_DIRTY') :
										$form->getInput('isadvfilter'); ?>
							</td>
						</tr>
						<?php endif; ?>
					</table>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>
			
			
			<?php if ($this->permission->CanConfig) :
				/*$this->document->addScriptDeclaration("
					window.addEvent('domready', function() {
						var slideaccess = new Fx.Slide('tabacces');
						var slidenoaccess = new Fx.Slide('notabacces');
						slideaccess.hide();
						$$('fieldset.flexiaccess legend').addEvent('click', function(ev) {
							slideaccess.toggle();
							slidenoaccess.toggle();
						});
					});
				");*/
			?>
			<div class="tabbertab" id="fcform_tabset_common_basic_tab" data-icon-class="icon-power-cord" >
				<h3 class="tabberheading"> <?php echo JText::_( 'FLEXI_PERMISSIONS' ); ?> </h3>
				
				<?php /*
				<fieldset class="flexiaccess">
					<legend><?php echo JText::_( 'FLEXI_RIGHTS_MANAGEMENT' ); ?></legend-->
					<div id="tabacces">
				*/ ?>
						<div id="access"><?php echo $this->form->getInput('rules'); ?></div>
				<?php /*
					</div>
					<div id="notabacces">
					<?php echo JText::_( 'FLEXI_RIGHTS_MANAGEMENT_DESC' ); ?>
					</div>
				</fieldset>
				*/ ?>
				
			</div>
			<?php endif; ?>		
			
		</div>

	</div>
	<div class="span6 full_width_980 padded_wrap_box" style="padding: 0px 0 0 24px">
			
			<span class="fcsep_level0" style="margin:0 0 12px 0; background-color:#333; "><?php echo JText::_( /*'FLEXI_THIS_FIELDTYPE_PROPERTIES'*/'FIELD TYPE specific configuration' ); ?></span>
			
			<div id="fieldspecificproperties">
				<div class="fctabber fields_tabset" id="field_specific_props_tabset" >
				<?php
				$fieldSets = $form->getFieldsets('attribs');
				$field_type = $form->getValue("field_type", NULL, "text");
				$prefix_len = strlen('group-'.$field_type.'-');
				if ($field_type) foreach ($fieldSets as $name => $fieldSet)
				{
					if ($name!='basic' && $name!='standard' && (substr($name, 0, $prefix_len)!='group-'.$field_type.'-' || $name==='group-'.$field_type) ) continue;
					if ($fieldSet->label) $label = JText::_($fieldSet->label);
					else $label = $name=='basic' || $name=='standard' ? JText::_('FLEXI_BASIC') : ucfirst(str_replace("group-", "", $name));
					
					if (@$fieldSet->label_prefix) $label = JText::_($fieldSet->label_prefix) .' - '. $label;
					$icon = @$fieldSet->icon_class ? 'data-icon-class="'.$fieldSet->icon_class.'"' : '';
					$prepend = @$fieldSet->prepend_text ? 'data-prefix-text="'.JText::_($fieldSet->prepend_text).'"' : '';
					
					$description = $fieldSet->description ? JText::_($fieldSet->description) : '';
					?>
					<div class="tabbertab" id="fcform_tabset_<?php echo $name; ?>_tab" <?php echo $icon; ?> <?php echo $prepend; ?>>
						<h3 class="tabberheading" title="<?php echo $description; ?>"><?php echo $label; ?> </h3>
						<?php $i = 0; ?>
						<?php foreach ($form->getFieldset($name) as $field) {
							$_depends = FLEXI_J30GE ? $field->getAttribute('depend_class') :
								$form->getFieldAttribute($field->__get('fieldname'), 'depend_class', '', 'attribs');
							echo '
							<fieldset class="panelform'.($i ? '' : ' fc-nomargin').' '.($_depends ? ' '.$_depends : '').'" id="'.$field->id.'-container">
								'.($field->label ? '
									<span class="label-fcouter">'.str_replace((FLEXI_J30GE ? 'hasTooltip' : 'hasTip'), (FLEXI_J30GE ? 'hasTooltip label' : 'hasTip label'), $field->label).'</span>
									<span class="container_fcfield">'.$field->input.'</span>
								' : $field->input).'
							</fieldset>
							';
							$i++;
						} ?>
					</div>
					<?php
				} else {
					echo "<br /><span style=\"padding-left:25px;\"'>" . JText::_( 'FLEXI_APPLY_TO_SEE_THE_PARAMETERS' ) . "</span><br /><br />";
				}
				?>
				</div>
			</div>

	</div>

</div>


<?php echo JHTML::_( 'form.token' ); ?>
<input type="hidden" name="option" value="com_flexicontent" />
<?php if ($form->getValue('iscore') == 1) : ?>
<input type="hidden" name="jform[iscore]" value="<?php echo $form->getValue("iscore"); ?>" />
<input type="hidden" name="jform[name]" value="<?php echo $form->getValue("name"); ?>" />
<?php endif; ?>
<input type="hidden" name="jform[id]" value="<?php echo $form->getValue("id"); ?>" />
<input type="hidden" name="controller" value="fields" />
<input type="hidden" name="view" value="field" />
<input type="hidden" name="task" value="" />
</form>
</div>
<div style="margin-bottom:24px;"></div>
			
<?php
//keep session alive while editing
JHTML::_('behavior.keepalive');
?>
