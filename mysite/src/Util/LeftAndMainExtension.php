<?php

namespace mysite;

class LeftAndMainExtension extends \LeftAndMainExtension {
	public function init() {
		parent::init();
		\CMSMenu::remove_menu_item('Help');
		$editorCss = project() . '/css/editor.scss.css';
		$editorCss .= '?t=' . filemtime(\Director::getAbsFile($editorCss));
		\HtmlEditorConfig::get_active()->setOption('content_css', $editorCss);
		//\Requirements::css(project() . '/scss/cms.scss');
		\Requirements::css(project() . '/css/cms.scss.css');
	}
}
