<?php
/**
 * Created by PhpStorm.
 * User: Mobarok Hossen
 * Date: 3/6/2019
 * Time: 12:39 PM
 */

use App\ProductCategory;

if (! function_exists('human_words')) {
    /**
     * Return human readable string from camel case or snake case string.
     *
     * @param $string
     * @return string
     */
    function human_words($string)
    {
//        $string = snake_case($string);
        $string = ucwords(str_replace('_', ' ', $string));

        return $string;
    }
}


if (! function_exists('api_access_key_generate')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function api_access_key_generate($name)
    {
        $string = md5(date('Ymd').$name.str_random(5));

        return $string;
    }
}

if (! function_exists('member_code_generate')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function member_code_generate()
    {
        $string = "M".str_random(1).date('Ymds');

        return $string;
    }
}



if (! function_exists('storage_asset')) {
    /**
     * Generate an asset storage path for the application.
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function storage_asset($path, $secure = null)
    {
        return app('url')->asset('storage/'. $path, $secure);
    }
}

if (! function_exists('verify_token_generate')) {
    /**
     * Return string Verify Token
     *
     * @param $string
     * @return string
     */
    function verify_token_generate($value='')
    {
        $string = md5($value.str_random(15));

        return $string;
    }
}

if (! function_exists('file_name_generator')) {
    /**
     * Return string FileName
     *
     * @param $string
     * @return string
     */
    function file_name_generator($value='')
    {
        $value = snake_case($value);
        $string = $value."_".date('Ymdhis');
//        $string = $value."_".str_random(10)."_".date('Ymdhis');

        return $string;
    }
}



if (! function_exists('date_month_year_format')) {
    /**
     * Return string Date d-m-Y Format
     *
     * @param $string
     * @return string
     */
    function date_month_year_format($value)
    {
        $string = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value);

        return $string->format('d-m-Y');
    }
}


if (! function_exists('formatted_date_string')) {
    /**
     * Return Written Format in date
     * As like Dec 20, 2019
     *
     * @param $string
     * @return string
     */
    function formatted_date_string($value)
    {
        $string = \Carbon\Carbon::parse($value);

        return $string->toFormattedDateString();
    }
}




if (! function_exists('db_date_format')) {

    /**
     * Return string Y-m-d format Date
     *
     * @param $string
     * @return string
     */

    function db_date_format($value)
    {
        $string = \Carbon\Carbon::parse($value);

       return $string->format('Y-m-d');
    }
}


if (! function_exists('db_date_month_year_format')) {
    /**
     * Return string d-m-Y format Date
     *
     * @param $string
     * @return string
     */
    function db_date_month_year_format($value)
    {
            $string = \Carbon\Carbon::parse($value);

            return $string->format('d-m-Y');
    }
}

if (! function_exists('create_money_format')) {
    function create_money_format($value)
    {
        $string = number_format((float)$value, 2, '.', ',');

        return $string;

    }
}


if (! function_exists('create_float_format')) {
    function create_float_format($value, $decimal = 2)
    {
        $string = round($value, $decimal);;

        return $string;

    }
}

if (! function_exists('month_date_year_format')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function month_date_year_format($value)
    {
        $string = \Carbon\Carbon::parse($value);

        return $string->format('m-d-Y');
    }
}

if (! function_exists('date_string_format_with_time')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function date_string_format_with_time($value)
    {
        $string = \Carbon\Carbon::parse($value);

        return $string->toDayDateTimeString();;
    }
}

if (! function_exists('create_date_format')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function create_date_format($value, $format="-")
    {
        $originalDate = $value;
        return date("m".$format."d".$format."Y", strtotime($originalDate));
    }
}

if (! function_exists('transaction_code_generate')) {
    /**
     * Return Transaction Code
     *
     * @return string
     */
    function transaction_code_generate()
    {
        $string = "TC".date('Ymdhis');

        return $string;
    }
}


if (! function_exists('count_digit')) {
    /**
     * Return Count
     *
     * @return string
     */
    function count_digit($number)
    {
        return strlen($number);
    }
}

if (! function_exists('format_number_digit')) {
    /**
     * Return Formatted Digit
     *
     * @return string
     */

    function format_number_digit($value)
    {
        $number = strlen($value);
        $string = $value;

        if($number==1)
            $string = "00".$string;
        elseif ($number==2)
            $string = "0".$string;
//        elseif ($number==3)
//            $string = "0".$string;

        return $string;
    }
}


if (! function_exists('emptyCheck')) {
    /**
     * Return string
     *
     * @return string
     */

    function emptyCheck($value)
    {
        $string = !empty($value) ? $value : "";
        return $string;
    }
}



if (! function_exists('filename')) {
    /**
     * Return string
     *
     * @return string
     */

    function filename($value)
    {
        $string = \Carbon\Carbon::today();

        return str_replace(' ','_',$value.$string->format('d_m_Y'));
    }
}


if (! function_exists('requestURLPath')) {
    /**
     * Return string
     *
     * @return string
     */

    function requestURLPath($value, $current)
    {
        $string = str_replace($current,'', $value);
        return $string;
    }
}

if (! function_exists('memo_generate')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function memo_generate($str, $id)
    {
        $num = format_number_digit($id);
        $string = $str.$num;

        return $string;
    }
}

if (! function_exists('return_code_generate')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function return_code_generate($type='')
    {
        $string = $type."R".date('Ymdhis');

        return $string;
    }
}


if (! function_exists('sale_code_generate')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function sale_code_generate()
    {
        $string = "SL".date('Ymdhis');

        return $string;
    }
}

if (! function_exists('previous_year_last_date')) {
    /**
     * Return
     *
     * @param $string
     * @return string
     */
    function previous_year_last_date()
    {
        $day = new \Carbon\Carbon('last day of last year');;

        return $day;
    }
}



if (! function_exists('header_shortname')) {
    /**
     * Return human readable string from camel case or snake case string.
     *
     * @param $string
     * @return string
     */
    function header_shortname($string)
    {

        $string = str_replace('_', ' ', $string);
        $pieces = explode(" ", $string);

        $name = '';
        for($i=0; $i<count($pieces); $i++)
        {
            $first_char = substr($pieces[$i], 0, 1);
            if($i==0)
                $name .= "<b>".$first_char."</b>";
            else
                $name .=$first_char;
        }

        return $name;
    }
}



if (! function_exists('slug')) {
    /**
     * Return human readable string from camel case or snake case string.
     *
     * @param $string
     * @return string
     */
    function slug($string)
    {

        $string = strtolower( str_replace(" ", "-", str_replace('_', '-', $string)));

        return $string;

    }
}

if (! function_exists('findSubCategory')) {


    function findSubCategory($id=null)
    {

        if (\Illuminate\Support\Facades\Schema::hasTable('product_categories')) {

            $subCategory = ProductCategory::getSubCategory($id)->active()->select('id', 'name', 'slug')->get();

            $sub_categories = [];

            foreach ($subCategory as $key => $value) {
                $sub_categories[$key]['id'] = $value->id;
                $sub_categories[$key]['name'] = $value->name;
                $sub_categories[$key]['slug'] = $value->slug;
                $sub_categories[$key]['sub_category'] = findSubCategory($value->id);

            }

            return $sub_categories;
        }
    }
}



