<?php

namespace Message\Mothership\Install\Project\PostInstall\File;

/**
 * Class Collection
 * @package Message\Mothership\Install\Project\PostInstall\File
 *
 * @author Thomas Marchant <thomas@message.co.uk>
 *
 * A collection of all the files to be created after the install has taken place
 */
class Collection extends \ArrayObject
{
	public function __construct()
	{
		$files = [
			new AssetsGitignoreFile,
			new BarcodesGitignoreFile,
			new CogulesGitignoreFile,
			new DataGitignoreFile,
			new FilesGitignoreFile,
			new HtaccessFile,
			new IndexFile,
			new ResizeGitignoreFile,
			new RobotsTxtFile,
			new TmpGitignoreFile,
		];

		parent::__construct($files);
	}
}