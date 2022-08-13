<?php 
    function makeActiveSidebar($for) {
        $segments = \Config\Services::uri()->getSegments();
       
        return in_array($for, $segments) ? 'active' : '';
    }