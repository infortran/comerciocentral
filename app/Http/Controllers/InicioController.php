<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\TeamMember;
use App\FooterInfo;

class InicioController extends Controller
{
    public function index(){
    	$header = HeaderFrontend::findOrFail(1);
    	$footer = FooterInfo::findOrFail(1);
    	$members = TeamMember::all();
    	return view('frontend.inicio', [
    		'header' => $header,
    		'footer' => $footer,
    		'members' => $members]);
    }
}
