<?php
/**
 * 分页分码
 * @category WuxcBlog
 * @copyright Copyright (c) 2016 WuxcBlog team (http://www.iwuxc.con)
 * @license GNU General Public License 2.0
 * @link www.iwuxc.com
 */

namespace Wuxc\Apps\Helpers;

class paginatorHelper
{
    /**
     * 获取分页页码
     * @param $totalRows
     * @param $page
     * @param int $pagesize
     * @param int $num
     * @return array
     */
    public static function get_paginator($totalRows, $page, $pagesize=10, $num=5)
    {
        $page = intval($page);
        $page <= 0 && $page = 1;

        //总页码
        $totalPage = ceil($totalRows / $pagesize);
        //判断最大页
        $page > $totalPage && $page = $totalPage;
        //根据$num计算起始页码
        $space = floor($num / 2);
        if($page == 1){//当前页码为1
            $startPage = 1;
            $endPage = $num;
        }else if($page == $totalPage){//当前页码为最后一页
            $endPage = $totalPage;
            $startPage = $endPage - $num + 1;
        }else if($page - $space <= 0){//当前页码小于间隔
            $startPage = $pagesize - $space;
            $endPage = $startPage + $num - 1;
            if($endPage > $totalPage){
                $startPage = $totalPage - $num + 1;
            }
        }
        $startPage <= 0 && $startPage = 1;
        $endPage > $totalPage && $endPage = $totalPage;
        $painator = range($startPage, $endPage);
        return $painator;
    }

    public static function get_page_url($page, $url = null)
    {
        $page = intval($page);
        $page <= 0 && $page = 1;
        empty($url) && $url = $_SERVER['REQUEST_URI'];
        $url = rtrim($url, '/');
        /** 组装URL */
        $index = strpos($url, '?');
        if($index === false){
            $url = "{$url}?page={$page}";
        } else {
            $url = "{$url}&page{$page}";
        }
        $array = parse_url($url);
        $str = isset($array['path']) ? $array['path'] : '';
        if(!empty($array['query'])){
            parse_str($array['query'], $queryArray);
            $query = http_build_query($queryArray);
            $str = "{$str}?{$query}";
        }
        return $str;
    }
}