<?php
defined("BASEPATH") or exit("No direct scrip access allowed!");

class Curl
{
	/**
	 * CI instance
	 * @access private
	 * @var object
	 */
	private $instance;

	/**
	 * Array of curl options
	 * @access private
	 * @var array
	 */
	private $options;

	/**
	 * Curl instance
	 * @access private
	 * @var object
	 */
	private $ch;

	/**
	 * Response header information
	 * @access private
	 * @var array
	 */
	private $header_info;

    /**
     * Curl result
     * @access private
     * @var
     */
    private $result;

	/**
	 * Public function construct
	 * initialize:
	 * 1) CI instance
	 * 2) array with options
	 * 3) curl instance
	 * @access public
	 */
	public function __construct()
	{
		$this->instance =& get_instance();

		$this->options = array();

		$this->ch = curl_init();

		$this->header_info = array();

        $this->result = "";
	}

	/**
	 * Public function call
	 * for adding new curl option
	 * @access public
	 * @return mixed
	 */
	public function __call($name, $value)
	{
		$option_name = strtoupper("CURLOPT_".$name);
		$constant = constant($option_name);

        $option_value = $value[0];

		if ($this->_add_option($constant,$option_value))
		{
			$this->options[$option_name] = $option_value;
            return true;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Add new option
	 * @access public
	 * @return mixed
	 */
	private function _add_option($name, $value)
	{
		return curl_setopt($this->ch, $name, $value);
	}

	/**
	 * Do curl request
	 * @access public
	 * @return mixed
	 */
	public function do_request()
	{
		$this->result = curl_exec($this->ch);
		$this->header_info = curl_getinfo($this->ch);

		if ($this->header_info === false || empty($this->header_info))
		{
			return null;
		}

		return intval($this->header_info["http_code"]);
	}

	/**
	 * Get curl result
	 * @access public
	 * @return string
	 */
	public function get_result()
	{
		return $this->result;
	}

	/**
	 * Get Curl header info
	 * @access public
	 * @param mixed curlHeader constant or null
	 * @return mixed
	 */
	public function get_header($param = null)
	{
		return
			is_null($param)
			? $this->header_info
			: isset($this->header_info[$param])
				? $this->header_info[$param]
				: false;
	}

	/**
	 * Get last curl error
	 * @access public
	 * @return mixed
	 */
	public function get_error()
	{
		return curl_error($this->ch);
	}

	/**
	 * Get last curl error number
	 * @access public
	 * @return mixed
	 */
	public function get_errno()
	{
		return curl_errno($this->ch);
	}

	/**
	 * Reset curl options
	 * @access public
	 * @return null
	 */
	public function do_reset()
	{
		curl_reset($this->ch);
	}

	/**
	 * Do curl pause
	 * @access public
	 * @param int
	 * @return mixed
	 */
	public function do_pause($seconds = 0)
	{
		$result = curl_pause($this->ch, constant("CURLPAUSE_".strval($seconds)));

		return $result === CURLE_OK
			? true
			: intval($result);
	}

	/**
	 * close curl
	 * @access public
	 * @return null
	 */
	public function do_close()
	{
		curl_close($this->ch);
	}

	/**
	 * init curl
	 * @access public
	 * @return null
	 */
	public function do_init()
	{
		$this->ch = curl_init();
	}

    /**
     * Public destructor
     */
    public function __destruct()
    {
        $this->do_close();
    }
}
?>