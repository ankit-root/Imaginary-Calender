<?php


include_once 'imaginary_calendar.php';

$imCalendar = new ImaginaryCalendar();

print "\n";
echo "<pre>";
print $imCalendar->get_date_day(); // return Monday
print "\n";
print $imCalendar->get_year_total_days('2033'); //gives 280
print "\n";
print $imCalendar->get_year_total_days('2030'); //gives 279
print "\n";
print $imCalendar->is_Leap_Year("1995"); // gives true
print "\n";
print $imCalendar->is_Leap_Year("1996"); // gives fales
print "\n";
print $imCalendar->get_date_day("01.01.1990"); //Returns "Monday"
print "\n";
print $imCalendar->get_date_day_index("01.13.1900"); // return day of week 2
print "\n";
print $imCalendar->get_month_name("2"); //return "Febuary"
print "\n";
print $imCalendar->get_month_total_days("11","2021"); // return 22
print "\n";
print $imCalendar->get_month_total_days("12","2021"); // return 21
print "\n";
print $imCalendar->get_month_name("14"); //return "Febuary"  //Error on line 6 in /var/www/html/myslim/fkcalendar-master/index.php: Invalid Month format provided
