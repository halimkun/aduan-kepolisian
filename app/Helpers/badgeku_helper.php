<?php 
    function badgeGen($roles) {
        if ($roles == 'admin') {
            return '<span class="badge badge-primary">'.$roles.'</span>';
        } else if ($roles == 'pengguna') {
            return '<span class="badge badge-dark">'.$roles.'</span>';
        } else {
            return '<span class="badge badge-danger">'.$roles == "" ? 'undefined' : $roles.'</span>';
        }
    }