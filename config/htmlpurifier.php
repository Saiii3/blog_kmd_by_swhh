<?php

return [
    'settings' => [
        'core' => [
            'encoding' => 'UTF-8',
            'doctype' => 'XHTML 1.0 Strict'
        ],
    ],
    'default' => [
        'HTML.Doctype'             => 'HTML 4.01 Transitional',
        'HTML.Allowed'             => 'div,b,strong,i,em,a[href|title|target],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
        'CSS.AllowedProperties'    => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
        'AutoFormat.AutoParagraph' => true,
        'AutoFormat.RemoveEmpty'   => true,
    ],
];

$config = \HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'UTF-8');
$config->set('HTML.Doctype', 'HTML 4.01 Transitional');

$purifier = new \HTMLPurifier($config);
$clean_html = $purifier->purify($dirty_html);
