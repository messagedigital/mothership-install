<?php

namespace Message\Mothership\Install\Project\PostInstall\File;

class RobotsTxtFile implements FileInterface
{
	public function getFilename()
	{
		return 'robots.txt';
	}

	public function getPath()
	{
		return 'public';
	}

	public function getContents()
	{
		return  <<<'EOD'
User-agent: *
Disallow: /admin
EOD;

	}
}