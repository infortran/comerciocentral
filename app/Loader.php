<?php

namespace App;

class Loader{

    private $header, $footer, $members, $socials;

    public function __construct(){
        $this->header = HeaderFrontend::find(1);
        $this->footer = FooterInfo::find(1);
        $this->members = TeamMember::all();
        $this->socials = SiteSocial::all();
    }

    public function getData(){
        $data = [
            'header' => $this->header,
            'footer' => $this->footer,
            'members' => $this->members,
            'siteSocials' => $this->socials
        ];
        return $data;
    }
}
