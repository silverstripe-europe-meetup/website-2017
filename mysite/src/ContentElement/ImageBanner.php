<?php

/**
 * DataObject classes can not be namespaced in SilverStripe 3.x
 *
 * @author zauberfisch
 * @property string $Title
 * @property string $LinkMode
 * @property string $LinkCustomURL
 * @property boolean $LinkNewTab
 * @property string $Height
 * @property int $VersionGroupPreviousID
 * @property int $ImageID
 * @property int $LinkPageID
 * @method Image Image()
 * @method Page LinkPage()
 * @mixin zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension
 */
class mysite_ContentElement_ImageBanner extends \PageBuilder_Model_ContentElement_AbstractContentElement {
	private static $db = [
		'Title' => 'Varchar(255)',
		'LinkMode' => 'Varchar',
		'LinkCustomURL' => 'Varchar(1000)',
		'LinkNewTab' => 'Boolean',
		'Height' => 'Varchar',
	];
	private static $has_one = [
		'Image' => 'Image',
		'LinkPage' => 'Page',
	];
	private static $extensions = [
		\zauberfisch\PersistentDataObject\Model\VersionedDataObjectExtension::class,
	];
	
	public function Link() {
		if ($this->LinkMode == 'popup') {
			$i = $this->Image();
			if ($i && $i->exists()) {
				return $i->getURL();
			}
		} elseif ($this->LinkMode == 'custom') {
			return $this->LinkCustomURL;
		} elseif ($this->LinkMode == 'page') {
			$p = $this->LinkPage();
			if ($p && $p->exists()) {
				return $p->Link();
			}
		}
		return null;
	}
	
	public function getPageBuilderPopupFields() {
		$return = parent::getPageBuilderPopupFields();
		$return->push(
			(new UploadField('Image', $this->fieldLabel('Image')))
				->setFolderName('banner')
		);
		$return->push(
			(new DropdownField('Height', $this->fieldLabel('Height'), [
				'100px' => '100',
				'150px' => '150',
				'200px' => '200',
				'300px' => '300',
				'400px' => '400',
				'450px' => '450',
				'600px' => '600',
			]))->setEmptyString('auto')
		);
		$return->push(new CompositeField([
			(new DropdownField('LinkMode', $this->fieldLabel('LinkMode'), [
				'' => _t('PageBuilder_Value_ContentElement_ImageBanner.LinkModeNone', 'none'),
				'page' => _t('PageBuilder_Value_ContentElement_ImageBanner.LinkModePage', 'Page'),
				'custom' => _t('PageBuilder_Value_ContentElement_ImageBanner.LinkModeCustom', 'Custom URL'),
				'popup' => _t('PageBuilder_Value_ContentElement_ImageBanner.LinkModePopup', 'Popup'),
			])),
			(new \DisplayLogicWrapper([
				new TreeDropdownField('LinkPageID', $this->fieldLabel('LinkPageID'), 'Page'),
			]))->hideUnless('LinkMode')->isEqualTo('page')->end(),
			(new \DisplayLogicWrapper([
				new TextField('LinkCustomURL', $this->fieldLabel('LinkCustomURL')),
			]))->hideUnless('LinkMode')->isEqualTo('custom')->end(),
			(new \DisplayLogicWrapper([
				new CheckboxField('LinkNewTab', $this->fieldLabel('LinkNewTab')),
			]))->displayIf('LinkMode')->isEqualTo('page')->orIf('LinkMode')->isEqualTo('custom')->end(),
		]));
		return $return;
	}
	
	public function PageBuilderPreview() {
		$i = $this->Image();
		if ($i && $i->exists()) {
			return sprintf(
				'<img src="%s" alt="" style="%s">',
				$i->FitMax(400, 300)->getURL(),
				'max-width: 100%;'
			);
		}
		return parent::PageBuilderPreview();
	}
}
