<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Blog
{
    public $title;
    public $slug;
    public $info;
    public $body;
    public function __construct($title, $slug, $info, $body) {
        $this->title = $title;
        $this->slug = $slug;
        $this->info = $info;
        $this->body = $body;
    }

    public static function all()
    {
        $files = File::allFiles(resource_path("views/blogs"));
        // collect()->map()
        // 
        $blogs = collect($files)->map(function($file) {
            $ymlObj = YamlFrontMatter::parseFile($file);
            return new Blog($ymlObj->title, $ymlObj->slug, $ymlObj->info, $ymlObj->body());
        });

        // Normal array_map
        // 
        // $blogs = array_map(function ($file){
        //     $ymlObj = YamlFrontMatter::parseFile($file);
        //     return new Blog($ymlObj->title, $ymlObj->slug, $ymlObj->info, $ymlObj->body());
        // }, $files);

        // using foreach
        // 
        // $blogs = [];
        // foreach($files as $file) {
        //     $ymlObj = YamlFrontMatter::parseFile($file);
        //     $blogs[] = new Blog($ymlObj->title, $ymlObj->slug, $ymlObj->info, $ymlObj->body());
        // }
        // dd($blogs);
        return $blogs;
    }

    public static function find($slug)
    {
        // New Version
        $blogs = static::all();
        return $blogs->firstWhere('slug', $slug); /* return $blogs->where('slug', $blog)->first(); */

        // Old Version 
    //     $path = resource_path("views/blogs/$blog.html");
    //     if(!file_exists($path)) {
    //         return redirect('/blogs');
    //     } else {
    //         $blog = file_get_contents($path);
    //         return $blog;
    //     }
    // }
    }
}