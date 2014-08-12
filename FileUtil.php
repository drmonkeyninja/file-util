<?php

class FileUtil {

/**
 * Returns a formatted filesize in B, KB, MB or GB
 *
 * @param string $path path to file to return filesize of
 * @return string
 */
	public function filesize($path)
	{
		$bytes = @sprintf('%u', filesize($path));

		if ($bytes > 0)
		{
			$unit = intval(log($bytes, 1024));
			$units = array('B', 'KB', 'MB', 'GB');
			if (array_key_exists($unit, $units) === true)
			{
				return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
			}

		}

		return $bytes;
	}

	
/**
 * Recursively removes a directory
 * 
 * @param string $path path of directory to be removed
 * @return void
 */
	public static function removeDirectory($path) 
	{

		$files = glob($path . '/*');
		foreach ($files as $file) 
		{
			is_dir($file) ? static::removeDirectory($file) : unlink($file);
		}
		rmdir($path);
		
	 	return;
	}
	

/**
 * Copies a directory and its contents recursively
 * 
 * @param string $source path of directory to be copied
 * @param string $dest path to copy the directory to
 * @return void
 */
	public static function copyDirectory($source, $dest)
	{
		$dir = opendir($source);

		if (mkdir($dest)===true) 
		{
			$files = glob($source . '/*');
			foreach ($files as $file)
			{
				$destFile = str_replace($source, $dest, $file);
				is_dir($file) ? static::copyDirectory($file, $destFile) : copy($file, $destFile);
			}
		}

		closedir($dir);

		return;
	}

}