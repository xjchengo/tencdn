<?php

if (!function_exists('cdn'))
{
    /**
     * Generate an asset path for the application. If cdn is set, use cdn path.
     *
     * local环境下一律使用本地地址，也就是asset函数生成的地址
     * production环境下，检测svn配置文件中的cdn是否为真，为真时使用cdn地址，不为真时使用本地地址
     * 实现思路：对asset函数进行封装，需要使用cdn地址时，把asset函数返回的地址中的域名替换成svn.url
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function cdn($path, $secure = null)
    {
        if (!Config::get('tencdn::svn.cdn'))
            return asset($path);
        else
            return Config::get('tencdn::svn.access_path').$path;

    }
}