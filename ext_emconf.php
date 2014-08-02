<?php

########################################################################
# Extension Manager/Repository config file for ext: "categories_example"
#
# Auto generated by Extbase Kickstarter 2014-01-01
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Category Selector',
	'description' => 'Generic category selector for lists of objects based on extbase/fluid and sys_category',
	'category' => 'frontend',
	'author' => 'Torsten Schrade',
	'author_email' => 'schradt@uni-mainz.de',
	'author_company' => 'Academy of Sciences and Literature | Mainz',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.1.0-6.2.99',
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);

?>