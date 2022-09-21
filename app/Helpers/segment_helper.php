<?php 
    function makeActiveSidebar($for) {
        $segments = \Config\Services::uri()->getSegments();
       
        return in_array($for, $segments) ? 'active' : '';
    }

    function makeActiveSidebar2($for, $for2) {
        $segments = \Config\Services::uri()->getSegments();
       
        return in_array($for, $segments) || in_array($for2, $segments) ? 'active' : '';
    }

    // active sidebar of end array
    function makeActiveSidebar3($for) {
        $segments = \Config\Services::uri()->getSegments();
       
        return end($segments) == $for ? 'active' : '';
    }