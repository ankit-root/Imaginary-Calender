# imaginarycalendar

Write PHP function, which returns day of standard seven days week of imaginary calendar, assuming we know how often a leap year occurs, how many months it has and how many days it has in each month. Use function to find the day of date 17.11.2013.

Definition of calendar:

- each year has 13 months
- each even month has 21 days, each odd month has 22 days
- in leap year last month has less one day
- leap year is each year dividable by five without rest
- every week has 7 days: Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday
- first day of year 1990 was Monday  

Usage example

include_once 'imaginary_calendar.php';

$imCalendar = new ImaginaryCalendar("17.11.2013");
or
$imCalendar = new ImaginaryCalendar(); // by default it'll take 01.01.1990

$imCalendar->get_year_total_days('2033'); //gives 280

$imCalendar->get_year_total_days('2030'); //gives 279

$imCalendar->is_Leap_Year("1995"); // gives true

$imCalendar->is_Leap_Year("1996"); // gives fales

$imCalendar->get_date_day("01.01.1990"); //Returns "Monday"

$imCalendar->get_date_day_index("01.13.1900"); // return day of week 2

$imCalendar->get_month_name("2"); //return "Febuary"

$imCalendar->get_month_total_days("11","2021"); // return 22

$imCalendar->get_month_total_days("12","2021"); // return 21

$imCalendar->get_month_name("14"); //return "Febuary"  //Error on line 6 in /var/www/html/myslim/fkcalendar-master/index.php: Invalid Month format provided
