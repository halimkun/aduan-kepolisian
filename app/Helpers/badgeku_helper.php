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

    function badgeStatusGen($status) {
        if ($status == 'pending') {
            return '<span class="text-warning" data-toggle="tooltip" title='.$status.'><i class="fas fa-hourglass-half"></i></span>';
        } else if ($status == 'proses') {
            return '<span class="text-info" data-toggle="tooltip" title='.$status.'><i class="fas fa-spinner"></i></span>';
        } else if ($status == 'selesai') {
            return '<span class="text-success" data-toggle="tooltip" title='.$status.'><i class="fas fa-check"></i></span>';
        } else {
            return '<span class="text-danger" data-toggle="tooltip" title="undefined"><i class="fas fa-times"></i></span>';
        }
    }