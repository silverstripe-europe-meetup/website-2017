<?php

/**
 * Class HomePage
 *
 * @property string $HeaderTitle
 * @property string $HeaderSubTitle
 * @property string $HeaderContent
 * @property int $HeaderBackgroundImageID
 * @method Image HeaderBackgroundImage()
 */
class HomePage extends Page {
	private static $db = [
		'HeaderTitle' => 'Varchar(255)',
		'HeaderSubTitle' => 'Text',
		'HeaderContent' => 'HTMLText',
		];
	private static $has_one = [
		'HeaderBackgroundImage' => 'Image',
	];
	
	public function getCMSFields() {
		$return = parent::getCMSFields();
		$return->addFieldsToTab('Root', [
			new Tab('Header', _t('Page.HeaderTab', 'Header')),
		]);
		$return->addFieldsToTab('Root.Header', [
			new UploadField('HeaderBackgroundImage', $this->fieldLabel('HeaderBackgroundImage')),
			new TextField('HeaderTitle', $this->fieldLabel('HeaderTitle')),
			new TextareaField('HeaderSubTitle', $this->fieldLabel('HeaderSubTitle')),
			new HtmlEditorField('HeaderContent', $this->fieldLabel('HeaderContent')),
		]);
		return $return;
	}
	
	public function Navigation() {
		$list = [];
		/** @var \zauberfisch\PageBuilder\Model\DBField $pageBuilder */
		$pageBuilder = $this->obj('PageBuilder');
		foreach ($pageBuilder->getValue() as $base) {
			/** @var \zauberfisch\PageBuilder\Model\Block\Base $base */
			foreach ($base->getBlocks() as $block) {
				/** @var \mysite\Block\PageSectionGroup|\zauberfisch\PageBuilder\Model\Block\AbstractBlock $block */
				if ($block->is_a(\mysite\Block\PageSectionGroup::class) && $block->getAnchor() && !isset($list[$block->getAnchor()])) {
					$list[$block->getAnchor()] = new ArrayData([
						'Link' => '/#' . $block->getAnchor(),
						'Title' => $block->getMenuTitle(),
						'MenuTitle' => $block->getMenuTitle(),
					]);
				}
			}
		}
		return new ArrayList(array_values($list));
	}
}

/**
 * Class HomePage_Controller
 *
 * @property HomePage dataRecord
 * @method HomePage data()
 * @mixin HomePage dataRecord
 */
class HomePage_Controller extends Page_Controller {
}
