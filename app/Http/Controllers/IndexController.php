<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        # 获取第一大类的分类集合，在后续版本中，取消多级分类，以Tag方式多维度进行细分类
        $categories = Category::where("parent_id", "><", 0)->orderBy("priority", "asc")->get();

        # 每次访问获取ip以及时间
        $timestamp = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        // laravel 内置方法获取ip
        $ip = $request->getClientIp();
        $this->storeIpLog($ip, $timestamp);
        // 原生PHP获取ip
        $ip = $this->getRealIp();
        $this->storeIpLog($ip, $timestamp);

        return view('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * 原生PHP获取IP的方式
     * @return array|false|mixed|string
     */
    protected function getRealIp()
    {
        $realip = '';
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
                foreach ($arr as $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }

        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
        return $realip;
    }

    /**
     * 存储每次访问的记录
     * @param $ip
     * @param $timestamp
     */
    protected function storeIpLog($ip, $timestamp)
    {
        /**
         * 此处调用一个查询ip的API接口
         */

        $ip = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
        $ip = json_decode($ip, true); // "{"code":0,"data":{"ip":"","country":"","area":"","region":"","city":"","county":"","isp":"","country_id":"","area_id":"","region_id":"","city_id":"","county_id":"","isp_id":""}}"

        if ($ip['code'] == 0) {
            $ip = $ip['data'];

            $log = [
                'ip' => $ip['ip'],
                'country' => $ip['country'],
                'area' => $ip['area'],
                'region' => $ip['region'],
                'city' => $ip['city'],
                'county' => $ip['county'],
                'isp' => $ip['isp'],
                'visited_at' => $timestamp,
            ];

            DB::table('test_visitor_logs')->insert($log);
        }
    }
}
