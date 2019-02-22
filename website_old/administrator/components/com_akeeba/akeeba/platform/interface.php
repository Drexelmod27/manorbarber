<?php
/**
 * Akeeba Engine
 * The modular PHP5 site backup engine
 * @copyright Copyright (c)2009-2012 Nicholas K. Dionysopoulos
 * @license GNU GPL version 3 or, at your option, any later version
 * @package akeebaengine
 * @version $Id: platform.php 900 2011-09-11 07:10:50Z nikosdion $
 */

interface AEPlatformInterface
{
	/**
	 * Returns an array with the directory/-ies in which the magic autoloader
	 * should look for platform overrides.
	 */
	public function getPlatformDirectories();
	
	/**
	 * Performs heuristics to determine if this platform object is the ideal
	 * candidate for the environment Akeeba Engine is running in.
	 * 
	 * @return bool
	 */
	public function isThisPlatform();
	
	/**
	 * Registers Akeeba Engine's autoloader with the current platform
	 */
	public function register_autoloader();
	
	/**
	 * Saves the current configuration to the database table
	 * @param	int		$profile_id	The profile where to save the configuration to, defaults to current profile
	 * @return	bool	True if everything was saved properly
	 */
	public function save_configuration($profile_id = null);
	
	/**
	 * Loads the current configuration off the database table
	 * @param	int		$profile_id	The profile where to read the configuration from, defaults to current profile
	 * @return	bool	True if everything was read properly
	 */
	public function load_configuration($profile_id = null);
	
	/**
	 * Returns an associative array of stock platform directories
	 * @return array
	 */
	public function get_stock_directories();
	
	/**
	 * Returns the absolute path to the site's root
	 * @return string
	 */
	public function get_site_root();
	
	/**
	 * Returns the absolute path to the installer images directory
	 * @return string
	 */
	public function get_installer_images_path();
	
	/**
	 * Returns the active profile number
	 * @return int
	 */
	public function get_active_profile();
	
	/**
	 * Returns the selected profile's name. If no ID is specified, the current
	 * profile's name is returned.
	 * @return string
	 */
	public function get_profile_name($id = null);
	
	/**
	 * Returns the backup origin
	 * @return string Backup origin: backend|frontend
	 */
	public function get_backup_origin();
	
	/**
	 * Returns a timestamp formatted for the current site's database driver
	 * 
	 * @param string $date[optional] The timestamp to use. Omit to use current timestamp.
	 * @return string
	 */
	public function get_timestamp_database($date = 'now');
	
	/**
	 * Returns the current timestamp, taking into account any TZ information,
	 * in the format specified by $format.
	 * @param string $format Timestamp format string (standard PHP format string)
	 * @return string
	 */
	public function get_local_timestamp($format);
	
	/**
	 * Returns the current host name
	 * @return string
	 */
	public function get_host();
	
	/**
	 * Creates or updates the statistics record of the current backup attempt
	 * @param int $id Backup record ID, use null for new record
	 * @param array $data The data to store
	 * @param AEAbstractObject $caller The calling object
	 * @return int|null|bool The new record id, or null if this doesn't apply, or false if it failed
	 */
	public function set_or_update_statistics( $id = null, $data = array(), &$caller );
	
	/**
	 * Loads and returns a backup statistics record as a hash array
	 * @param int $id Backup record ID
	 * @return array
	 */
	public function get_statistics($id);
	
	/**
	 * Completely removes a backup statistics record
	 * @param int $id Backup record ID
	 * @return bool True on success
	 */
	public function delete_statistics($id);
	
	/**
	 * Returns a list of backup statistics records, respecting the pagination
	 * 
	 * The $config array allows the following options to be set:
	 * limitstart	int		Offset in the recordset to start from
	 * limit		int		How many records to return at once
	 * filters		array	An array of filters to apply to the results. Alternatively you can just pass a profile ID to filter by that profile.
	 * order		array	Record ordering information (by and ordering) 
	 * 
	 * @return array
	 */
	function &get_statistics_list($config = array());
	
	/**
	 * Return the total number of statistics records
	 * 
	 * @param	array	$filters	An array of filters to apply to the results. Alternatively you can just pass a profile ID to filter by that profile.
	 * 
	 * @return int
	 */
	function get_statistics_count($filters = null);
	
	/**
	 * Returns an array with the specifics of running backups
	 * @return unknown_type
	 */
	public function get_running_backups($tag = null);
	
	/**
	 * Multiple backup attempts can share the same backup file name. Only
	 * the last backup attempt's file is considered valid. Previous attempts
	 * have to be deemed "obsolete". This method returns a list of backup
	 * statistics ID's with "valid"-looking names. IT DOES NOT CHECK FOR THE
	 * EXISTENCE OF THE BACKUP FILE!
	 * @param bool $useprofile If true, it will only return backup records of the current profile
	 * @param array $tagFilters Which tags to include; leave blank for all. If the first item is "NOT", then all tags EXCEPT those listed will be included.
	 * @return array A list of ID's for records w/ "valid"-looking backup files
	 */
	public function &get_valid_backup_records($useprofile = false, $tagFilters = array(), $ordering = 'DESC');
	
	/**
	 * Invalidates older records sharing the same $archivename
	 * @param string $archivename
	 */
	public function remove_duplicate_backup_records($archivename);
	
	/**
	 * Marks the specified backup records as having no files
	 * @param array $ids Array of backup record IDs to ivalidate
	 */
	public function invalidate_backup_records($ids);
	
	/**
	 * Gets a list of records with remotely stored files in the selected remote storage
	 * provider and profile.
	 * 
	 * @param $profile int (optional) The profile to use. Skip or use null for active profile.
	 * @param $engine string (optional) The remote engine to looks for. Skip or use null for the active profile's engine.
	 * @return array
	 */
	public function get_valid_remote_records($profile = null, $engine = null);
	
	/**
	 * Returns the filter data for the entire filter group collection
	 * @return array
	 */
	public function &load_filters();
	
	/**
	 * Saves the nested filter data array $filter_data to the database
	 * @param	array	$filter_data	The filter data to save
	 * @return	bool	True on success
	 */
	public function save_filters(&$filter_data);
	
	/**
	 * Gets the best matching database driver class, according to CMS settings
	 * @param bool $use_platform If set to false, it will forcibly try to assign one of the primitive type (AEDriverMySQL/AEDriverMySQLi) and NEVER tell you to use an AEPlatformDriver* class
	 * @return string
	 */
	public function get_default_database_driver( $use_platform = true );
	
	/**
	 * Returns a set of options to connect to the default database of the current CMS
	 * @return array
	 */
	public function get_platform_database_options();
	
	/**
	 * Provides a platform-specific translation function
	 * @param string $key The translation key
	 * @return string
	 */
	public function translate($key);
	
	/**
	 * Populates global constants holding the Akeeba version
	 */
	public function load_version_defines();
	
	/**
	 * Returns the platform name and version
	 * @param string $platform_name Name of the platform, e.g. Joomla!
	 * @param string $version Full version of the platform
	 */
	public function getPlatformVersion();
	
	/**
	 * Logs platform-specific directories with _AE_LOG_INFO log level
	 */
	public function log_platform_special_directories();
	
	/**
	 * Loads a platform-specific software configuration option
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get_platform_configuration_option($key, $default);
	
	/**
	 * Returns a list of emails to the Super Administrators
	 * @return unknown_type
	 */
	public function get_administrator_emails();
	
	/**
	 * Sends a very simple email using the platform's emailer facility
	 * @param string $to
	 * @param string $subject
	 * @param string $body
	 */
	public function send_email($to, $subject, $body, $attachFile = null);
	
	/**
	 * Deletes a file from the local server using direct file access or FTP
	 * @param string $file
	 * @return bool
	 */
	public function unlink($file);
	
	/**
	 * Moves a file around within the local server using direct file access or FTP
	 * @param string $from
	 * @param string $to
	 * @return bool
	 */
	public function move($from, $to);
	
	
}
