<?php

if (!function_exists('remove_query_param')) {
    /**
     * Supprime un paramètre de requête d'une URL
     */
    function remove_query_param($param, $url = null)
    {
        if ($url === null) {
            $url = current_url();
        }
        
        $parsed = parse_url($url);
        if (!isset($parsed['query'])) {
            return $url;
        }
        
        parse_str($parsed['query'], $query);
        unset($query[$param]);
        
        if (empty($query)) {
            unset($parsed['query']);
        } else {
            $parsed['query'] = http_build_query($query);
        }
        
        return build_url($parsed);
    }
}

if (!function_exists('build_url')) {
    /**
     * Construit une URL à partir de composants parsés
     */
    function build_url($parsed)
    {
        $scheme   = isset($parsed['scheme']) ? $parsed['scheme'] . '://' : '';
        $host     = isset($parsed['host']) ? $parsed['host'] : '';
        $port     = isset($parsed['port']) ? ':' . $parsed['port'] : '';
        $user     = isset($parsed['user']) ? $parsed['user'] : '';
        $pass     = isset($parsed['pass']) ? ':' . $parsed['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed['path']) ? $parsed['path'] : '';
        $query    = isset($parsed['query']) ? '?' . $parsed['query'] : '';
        $fragment = isset($parsed['fragment']) ? '#' . $parsed['fragment'] : '';
        
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}
