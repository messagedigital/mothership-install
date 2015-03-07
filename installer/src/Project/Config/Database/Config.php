<?php

namespace Message\Mothership\Install\Project\Config\Database;

use Message\Mothership\Install\Project\Config\Exception;
use Message\Mothership\Install\Project\Config\AbstractConfig;

/**
 * Class Config
 * @package Message\Mothership\Install\Project\Config\Database
 *
 * @author Thomas Marchant <thomas@message.co.uk>
 *
 * Class for setting the database configuration for the installation
 */
class Config extends AbstractConfig
{
	const CONFIG_PATH = 'config/db.yml';

	const HOST    = 'hostname';
	const USER    = 'user';
	const PASS    = 'pass';
	const NAME    = 'name';
	const CHARSET = 'charset';
	
	public function defaultConfig()
	{
		return array(
			self::HOST => '127.0.0.1',
			self::USER => 'user',
			self::PASS => 'password',
			self::NAME => 'table_name',
			self::CHARSET => 'utf8',
		);
	}

	/**
	 * {@inheritDoc}
	 */
	public function getConfigPath()
	{
		return self::CONFIG_PATH;
	}

	/**
	 * {@inheritDoc}
	 */
	public function askForDetails($path)
	{
		$asking = true;

		$dbConfig = $this->getConfig($path);

		while ($asking) {
			$this->_question->ask("Please enter your database details:");
			foreach ($this->defaultConfig() as $key => $value) {
				
				$this->_question->option($key . ' (defaults to `' . $value . '`):');
				$wait = true;
				while ($wait) {
					$fh = fopen('php://stdin', 'r');
					$input = fgets($fh, 1024);
					if (null !== $input) {
						$dbConfig[$key] = (trim($input) !== '') ? trim($input) : $value;
						$wait = false;
					}
				}
			}
			$asking = false;
		}

		$this->setConfig($path, $dbConfig);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validateConfig(array $dbConfig)
	{
		$required = [
			self::HOST,
			self::USER,
			self::PASS,
			self::CHARSET,
		];

		foreach ($required as $key) {
			if (!array_key_exists($key, $dbConfig) || !$dbConfig[$key]) {
				throw new Exception\ConfigException('Database details are missing `' . $key . '` option');
			}
		}
	}
}
