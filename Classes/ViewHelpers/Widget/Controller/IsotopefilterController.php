<?php
namespace ADWLM\CategorySelector\ViewHelpers\Widget\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Torsten Schrade <Torsten.Schrade@adwmainz.de>, Academy of Sciences and Literature | Mainz
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class IsotopefilterController extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController {

	/**
	 * @var \ADWLM\CategorySelector\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * @return void
	 */
	public function indexAction() {

		$levelCategoryUids = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['isotopeFilter']['parentCategories']);

		if ($this->settings['isotopeFilter']['categories2skip']) {
			$categories2skip = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->settings['isotopeFilter']['categories2skip']);
		}

		$categoryTree = array();

		// builds the category tree as two dimensional array - the keys represent the level of recursion, the values are
		// arrays of child categories per level bound together by the uid of their parent
		for ($i = 0; $i <= $this->settings['isotopeFilter']['recursive']; $i++) {
			if ($i === 0) {
				foreach ($levelCategoryUids as $currentCategoryUid) {
					$parent = $this->categoryRepository->findByUid($currentCategoryUid);
					$categoryTree[$i][] = $parent;
				}
			} else {
				$newLevelCategoryUids = array();
				foreach ($levelCategoryUids as $currentCategoryUid) {
					$parent = $this->categoryRepository->findByUid($currentCategoryUid);
					$children = $this->categoryRepository->findByParent($currentCategoryUid, $categories2skip);
					if ($children->count() > 0) {
						$categoryTree[$i][$parent->getUid()] = $children;
						foreach ($children as $child) {
							$newLevelCategoryUids[] = $child->getUid();
						}
					}
				}
				$levelCategoryUids = $newLevelCategoryUids;
			}
		}

		$this->view->assign('categoryTree', $categoryTree);

	}

}

?>
