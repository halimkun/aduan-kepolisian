<?php 
    function badgeGen($roles) {
        if ($roles == "admin") {
            return "<span class='badge badge-primary'>".$roles."</span>";
        } else if ($roles == "pengguna") {
            return "<span class='badge badge-dark'>".$roles."</span>";
        } else {
            return "<span class='badge badge-danger'>".$roles == "" ? "undefined" : $roles."</span>";
        }
    }

    function badgeStatusGen($status) {
        if ($status == "belum diproses") {
            return "<span class='text-warning' data-toggle='tooltip' title='belum diproses'><i class='fas fa-hourglass-half'></i><span class='d-none'>belum diproses</span></span>";
        } else if ($status == "dalam proses") {
            return "<span class='text-info' data-toggle='tooltip' title='dalam proses'><i class='fas fa-spinner'></i><span class='d-none'>dalam proses</span></span>";
        } else if ($status == "selesai") {
            return "<span class='text-success' data-toggle='tooltip' title='selesai'><i class='fas fa-check'></i><span class='d-none'>selesai</span></span>";
        } else {
            return "<span class='text-danger' data-toggle='tooltip' title='dibatalkan'><i class='fas fa-times'></i><span class='d-none'>dibatalkan</span></span>";
        }
    }