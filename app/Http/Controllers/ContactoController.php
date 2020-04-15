<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HeaderFrontend;
use App\FooterInfo;
use App\TeamMember;

class ContactoController extends Controller
{
    public function index(){
    	$header = HeaderFrontend::findOrFail(1);
    	$footer = FooterInfo::findOrFail(1);
    	$members = TeamMember::all();

    	return view('frontend.contacto',[
    		'header'=> $header,
    		'footer' => $footer,
    		'members' => $members]);
    }
}
