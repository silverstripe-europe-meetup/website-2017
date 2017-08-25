<?php

/**
 * Class Page
 *
 * @property string $PageBuilder
 */
class Page extends SiteTree {
	private static $db = [
		'PageBuilder' => \zauberfisch\PageBuilder\Model\DBField::class,
	];
	
	public function getCMSFields() {
		$return = parent::getCMSFields();
		if (!$this->is_a(ErrorPage::class) && !$this->is_a(RedirectorPage::class) && !$this->is_a(VirtualPage::class)) {
			$return->removeByName('Content');
			$return->addFieldsToTab('Root.Main', [
				new \zauberfisch\PageBuilder\Form\Field('PageBuilder', $this->fieldLabel('PageBuilder')),
			]);
		}
		return $return;
	}
	
	/**
	 * @return FieldList
	 */
	public function getSettingsFields() {
		$fields = parent::getSettingsFields();
		$fields->removeByName('ShowInSearch');
		return $fields;
	}
	
	public function Navigation() {
		/** @var HomePage $home */
		$home = HomePage::get()->first();
		if ($home && $home->exists()) {
			return $home->Navigation();
		}
		return new ArrayList();
	}
}

/**
 * Class Page_Controller
 *
 * @property Page dataRecord
 */
class Page_Controller extends ContentController {
	private static $allowed_actions = [];
	
	public function init() {
		$listFiles = function ($folder, $ext) {
			$folder = "{$this->ThemeDir()}/$folder";
			$len = strlen($ext) * -1;
			return array_filter(array_map(function ($fileName) use ($folder, $len, $ext) {
				return !in_array($fileName[0], ['.', '_']) && substr($fileName, $len) == $ext ? "$folder/$fileName" : false;
			}, scandir(BASE_PATH . "/$folder")));
		};
		Requirements::set_backend(new BetterRequirements_Backend());
		parent::init();
		Requirements::set_combined_files_folder(project() . '/_combinedfiles');
		Requirements::javascript('https://maps.googleapis.com/maps/api/js');
		Requirements::combine_files('main.js', array_merge(
			[
				PROJECT_THIRDPARTY_DIR . '/composer-bower/jquery/dist/jquery.min.js',
				PROJECT_THIRDPARTY_DIR . '/composer-bower/jquery.browser/dist/jquery.browser.min.js',
				PROJECT_THIRDPARTY_DIR . '/composer-bower/jquery.entwine/dist/jquery.entwine-dist.js',
				PROJECT_THIRDPARTY_DIR . '/composer-bower/magnific-popup/dist/jquery.magnific-popup.min.js',
				project() . '/javascript/plugins.js',
				project() . '/javascript/timer.js',
				project() . '/javascript/sync-height.js',
				project() . '/javascript/main.js',
			],
			$listFiles('javascript/Block', 'js'),
			$listFiles('javascript/ContentElement', 'js')
		));
		// insert modernizr into <head> for html5shiv to work
		Requirements::insertHeadTags(sprintf(
			'<script src="%s"></script>',
			PROJECT_THIRDPARTY_DIR . '/modernizr/modernizr.min.js'
		));
		Requirements::combine_files('main.css', array_merge(
			[
				PROJECT_THIRDPARTY_DIR . '/composer-bower/normalize-css/normalize.css',
				PROJECT_THIRDPARTY_DIR . '/composer-bower/magnific-popup/dist/magnific-popup.css',
				project() . '/scss/screen.scss',
				project() . '/scss/page-builder-grid.scss',
				project() . '/scss/typography.scss',
				project() . '/scss/form.scss',
				project() . '/scss/footer.scss',
				project() . '/scss/header.scss',
				project() . '/scss/layout.scss',
			],
			$listFiles('scss/Block', 'scss'),
			$listFiles('scss/ContentElement', 'scss')
		));
		Requirements::css(project() . '/scss/print.scss', 'print');
		Requirements::css(project() . '/scss/editor.scss');
		Requirements::clear(project() . '/css/editor.scss.css');
	}
}
