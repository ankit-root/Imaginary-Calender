<?php
define('IMAGINARY_CALENDAR_MONTHS', 13);
define('EVEN_MONTH_DAYS', 21);
define('ODD_MONTH_DAYS', 22);
define('YEAR_MONTHS_COUNT', 13);
define('INITIAL_YEAR', 1990);
define('INITIAL_FIRST_DAY', 1);
define('START_CALENDAR', "01.01.1990");


class ImaginaryCalendar extends Exception {
	public $dateStr = "";
	public $day;
	public $month;
	public $year;
	public function __construct($dateStr = NULL) {
		if (empty($dateStr))
		{
			$dateStr = $this->dateStr = START_CALENDAR;
		}
		try
		{
			// print $dateStr;die;
			if (!$this->isValidDateFormat($dateStr)) {
				// print
				throw new Exception(sprintf("Wrong Date provided") );
			}
			list($day, $month, $year) = explode('.', $dateStr);
			$day = (int) $day;
			$month = (int) $month;
			$year = (int) $year;

			if (!$this->isValidDay($day)) {
				throw new Exception("Wrong day provided");
			}

			if (!$this->isValidMonth($month)) {
				throw new Exception("Wrong Month provided" );
			}

			if (!$this->isValidYear($year) ) {
				throw new Exception("Wrong year provided");
			}
			if (!$this->isValidDayRange($day, $month, $year)) {
				throw new Exception("Wrong day  provided for selected year/month" );
			}
			$this->dateStr = $dateStr;
			$this->day = $day;
			$this->month = $month;
			$this->year = (int) $year;
		}
		catch (Exception $e)
		{
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}

	}
	/**
	 * @function get_week_days
	 * @return array - weekday names
	 */
	public function get_week_days() {
		return array('Sunday', 'Monday', 'Tuesday','Wednesday', 'Thursday', 'Friday', 'Saturday');
	}
	/**
	 * @function get_week_days
	 * @return array - weekday names
	 */
	public function get_month() {
		return array('January', 'Febuary', 'March','April', 'May', 'June', 'July','August','September','October','November','December','Alast');
	}
	/**
	 * @function isValidDate - checks is date in valid format
	* @param $dateStr - fomated date
	*/
	public static function isValidDateFormat($dateStr) {
		return preg_match('/^[0-2][0-9]+(\.)[0-1][0-9]+(\.)[1-2][0-9][0-9][0-9]/', $dateStr);
	}
	public function isValidDay($day) {
		return ($day > 0 && $day<23);
	}
	public function isValidMonth($month) {
		return ($month > 0 && $month <= IMAGINARY_CALENDAR_MONTHS);
	}
	public function isValidYear($year) {
		return ($year >=0 && strlen($year)==4);
	}
	public function isValidDayRange($day, $month, $year) {
		$total_days = $this->get_month_total_days($month,  $year);
		return ($day > 0 && $day <= $total_days);
	}
	/**
	 * @function is_leap_year
	* identifdies is year leap or not
	* @param $year
	* @return bool
	*/
	public function is_leap_year_inside($year =NULL) {
		if (empty($year)) {
			$year = $this->year;
		}
		return (($year % 5) === 0);
	}
	public function is_Leap_Year($year =NULL)
	{
		try {
			if (empty($year)) {
				$year = $this->year;
			}else {
				$year = (int)$year;
			}
			if (!$this->isValidYear($year)) {
				throw new Exception("Invalid Month format provided");
			}
			if (($year % 5) === 0) {
				return "treu";
			}else {
				return "false";
			}
		} catch (\Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}
	}
	public function get_month_name($month =NULL) {
		try {
			if (empty($month)) {
				$month = $this->month;
			}else {
				$month = (int) $month;
			}
			// print $month;die;
			if (!$this->isValidMonth($month)) {
				throw new Exception("Invalid Month format provided");
			}
			else {
				$month_array = $this->get_month();
				echo $month_array[--$month];
			}
		} catch (\Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}
	}
	/**
	 * @function get_year_total_days
	* @param $year
	* @return int - total days in year
	*/
	public function get_year_total_days($year = NULL) {
		try {
			if (empty($year)) {
				$year = $this->year;
			}
			else {
				$year = (int)$year;
			}
			if (!$this->isValidYear($year)) {
				throw new Exception("Wrong date format provided", 1);
			}
			$total_days = 0;
			for ($month = 1; $month <= YEAR_MONTHS_COUNT; $month++) {
				$total_days += $this->get_month_total_days($month , $year);
			}
			return $total_days;
		} catch (\Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}
	}
	/**
	 * @function get_month_total_days
	* @param $month - month for which calculate total days
	* @param $year - for which year month to calculate total days
	* @return int - total days in choosen month, year
	*/
	function get_month_total_days($month = NULL,  $year = NULL) {
		try {
			if (empty($month)) {
				$month = $this->month;
			}else {
				$month = (int)$month;
			}
			if (empty($year)) {
				$year = $this->year;
			}else {
				$year = (int) $year;
			}
			if (!$this->isValidMonth($month)) {
				throw new Exception("Wrong month format provided", 1);
			}
			if (!$this->isValidYear($year)) {
				throw new Exception("Wrong year format provided", 1);
			}
			$total_days = ($month % 2 == 0 ) ? EVEN_MONTH_DAYS : ODD_MONTH_DAYS;
			if ($month == YEAR_MONTHS_COUNT && $this->is_leap_year_inside($year)) {
				$total_days--;
			}
			return $total_days;
		} catch (\Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}


	}
	/**
	 * @function get_date_day - calculates day index for chosen date
	* @param $date_str - date in format d.m.Y
	* @return Exception|int - index of week day or exception on error
	*/
	function get_date_day_index($date_str =  NULL) {
		try {
			if (!empty($date_str)) {
				if (!$this->isValidDateFormat($date_str)) {
					throw new Exception("Invalid date format provided");
				}
				list($day, $month, $year) = explode('.', $date_str);
				$day = (int) $day;
				$month = (int) $month;
				$year = (int) $year;
				if (!$this->isValidYear($year)) {
					throw new Exception("Invalid year");
				}
				if (!$this->isValidMonth($month)) {
					throw new Exception("Invalid month");
				}
				if (!$this->isValidDay($day)) {
					throw new Exception("Invalid month");
				}
				if (!$this->isValidDayRange($day, $month, $year)) {
					throw new Exception("Invalid day range In this month",1);
				}
			}
			else
			{
				$day = $this->day;
				$month = $this->month;
				$year = $this->year;
			}
			$year_diff = ($year - INITIAL_YEAR);
			//find out how many years do we have
			$min_year = ($year_diff <= 0) ? $year : INITIAL_YEAR;
			$max_year = ($year_diff <= 0) ? INITIAL_YEAR :  $year;
			$total_days = 0;
			$week_days = $this->get_week_days();
			$week_days_count = sizeof($week_days);
			$tmp_year = $min_year;
			$max_year_prev_year = $max_year -1;
			if ($min_year != $max_year) {
				do {
					$total_days += $this->get_year_total_days($tmp_year);
					$tmp_year++;
				}  while ($tmp_year < $max_year_prev_year);
			}
			$prev_month = ($month - 1);
			for ($tmp_month = 1; $tmp_month <= $prev_month; $tmp_month++) {
				$total_days += $this->get_month_total_days($tmp_month, $tmp_year);
			}
			$total_days += $day;
			//calculate how many weeks do we have in this total days
			$week_count = floor($total_days / $week_days_count);
			//get nearest first day
			$week_first_day = $week_count * $week_days_count;
			return ($total_days - $week_first_day);
		} catch (Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}
	}
	function get_date_day($dateStr = NULL) {
		try {
			if (empty($dateStr)) {
				$dateStr = $this->dateStr;
			}
			// echo $dateStr;
			$index = $this->get_date_day_index($dateStr);
			$week_days = $this->get_week_days();
			return $week_days[$index];
		} catch (\Exception $e) {
			echo $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().': <b>'.$e->getMessage().'</b>';die;
		}
	}
}
