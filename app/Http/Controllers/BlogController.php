<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;
use App\Post;

class BlogController extends Controller
{
    public function index(){
    	$header = HeaderFrontend::findOrFail(1);
    	$footer = FooterInfo::findOrFail(1);
    	$members = TeamMember::all();

    	return view('frontend.blog.index',[
    		'header' => $header,
    		'footer' => $footer,
    		'members' => $members]);
    }

    public function single(){
    	$header = HeaderFrontend::findOrFail(1);
    	$footer = FooterInfo::findOrFail(1);
    	$members = TeamMember::all();

    	return view('frontend.blog.blog-single',[
    		'header' => $header,
    		'footer' => $footer,
    		'members' => $members]);
    }

}
