<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CSV Import Library
 *
 * This library handles CSV file imports
 */
class Csvimport
{
    private $handle = null;
    private $filepath = null;
    private $column_headers = false;
    private $initial_line = 0;
    private $delimiter = ',';
    private $detect_line_endings = false;
    private $ci;

    /**
     * Constructor
     */
    public function __construct($config = array())
    {
        $this->_set_options($config);
        
        // Library will auto-load the Input class
        $this->ci =& get_instance();
    }

    /**
     * Set options
     *
     * @param array $options
     * @return void
     */
    private function _set_options($options = array())
    {
        foreach ($options as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
        
        if ($this->detect_line_endings) {
            ini_set("auto_detect_line_endings", true);
        }
    }

    /**
     * Parse CSV file and return as array
     *
     * @param string $filepath
     * @param bool $column_headers
     * @param int $initial_line
     * @param string $delimiter
     * @return array|bool
     */
    public function get_array($filepath = null, $column_headers = null, $initial_line = null, $delimiter = null)
    {
        // File path
        if (!empty($filepath)) {
            $this->filepath = $filepath;
        }
        
        // Column headers
        if (isset($column_headers)) {
            $this->column_headers = $column_headers;
        }
        
        // Initial line
        if (isset($initial_line)) {
            $this->initial_line = $initial_line;
        }
        
        // Delimiter
        if (isset($delimiter)) {
            $this->delimiter = $delimiter;
        }
        
        // Open the file
        if (!$this->_get_handle()) {
            return false;
        }
        
        // Parse the CSV
        $row_count = 0;
        $data = array();
        $headers = array();
        
        while (($row = fgetcsv($this->handle, 0, $this->delimiter)) !== false) {
            // Skip initial lines
            if ($row_count < $this->initial_line) {
                $row_count++;
                continue;
            }
            
            // If first line contains column headers
            if ($row_count == $this->initial_line && $this->column_headers) {
                // Use headers for keys
                foreach ($row as $key => $header) {
                    $headers[$key] = trim(strtolower($header)); // Trim and lowercase headers for consistency
                }
                $row_count++;
                continue;
            }
            
            // Build data
            $item = array();
            foreach ($row as $key => $field) {
                if ($this->column_headers && isset($headers[$key])) {
                    $item[$headers[$key]] = $field;
                } else {
                    $item[$key] = $field;
                }
            }
            $data[] = $item;
            $row_count++;
        }
        
        // Close the file
        fclose($this->handle);
        
        return $data;
    }

    /**
     * Get the file handle
     *
     * @return bool
     */
    private function _get_handle()
    {
        if (!file_exists($this->filepath) || !is_readable($this->filepath)) {
            return false;
        }
        
        $this->handle = fopen($this->filepath, "r");
        
        return $this->handle ? true : false;
    }
} 