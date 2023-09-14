<?php 

function assetJs($path) 
{
    return asset('assets/js/' . $path);
}

function assetCss($path) 
{
    return asset('assets/css/' . $path);
}

function assetImg($path)
{
    return asset('assets/images/' . $path);
}

function assetPlugin($path)
{
    return asset('assets/plugins/' . $path);
}