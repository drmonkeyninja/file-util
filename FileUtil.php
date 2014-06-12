<?php

class FileUtil {
	
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

		if (mkdir($dest)===true) {
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