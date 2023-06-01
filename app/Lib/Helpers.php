<?php

use GuzzleHttp\Client;
use Illuminate\Http\Response as ResponseAlias;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;



function showToast($message, $type) {
    session()->flash("toast", json_encode([
        "message" => $message,
        "type" => $type
    ]));
}

function removeWhiteSpaces($string)
{
    return preg_replace('/\s+/', '', $string);
}


function apiResponse($results, $status = ResponseAlias::HTTP_OK)
{
    return response()->json([
        "results" => $results,
    ], $status);
}

function apiErrorResponse($message, $errors = [], $status = ResponseAlias::HTTP_BAD_REQUEST)
{
    return response()->json([
        "message" => $message,
        "errors" => $errors
    ], $status);
}

function isLinkActive(array $links, $class = "active")
{
    foreach ($links as $link) {
        if (Request::is($links)) {
            return $class;
        }
    }
    return "";
}

function generateRandomString($length = 6)
{
    $alphabet = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $id = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $p = mt_rand(0, $alphaLength);
        $id[] = $alphabet[$p];
    }
    return implode($id);
}

function generateRandomNumber($length = 6)
{
    $alphabet = '123456789';
    $id = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $p = mt_rand(0, $alphaLength);
        $id[] = $alphabet[$p];
    }
    return implode($id);
}

function storeFile($path, $file)
{
    $filen = implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));
    $filename = $path . $filen . '.' . $file->getClientOriginalExtension();
    Storage::disk('public')->put($filename, File::get($file));
    return (object)["filename" => $file->getClientOriginalName(), "file_path" => $filename];
}

function formatDate($date, $format = "d/M/y")
{
    try {
        $carbonDate = \Carbon\Carbon::parse($date);
        return $carbonDate->format($format);
    } catch (Exception $exception) {
        return $date;
    }
}

function randomColor()
{
    $colors = [
        '#A3A1FB', '#DDDF00', '#24CBE5', '#64E572', '#FF9655',
        '#9DFCFF', '#FFD59D', '#FC46FC', '#00E5E5', '#E500B9',
        '#6CC476', '#E59F00'
    ];

    return $colors[array_rand($colors)];
}

// ?>
