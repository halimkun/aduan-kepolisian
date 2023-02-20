<?php
function getUserName($id)
{
    $user = new \App\Models\UserModel();
    $user = $user->find($id);
    return $user->nama;
}

// user themes
function userColor()
{
    if (logged_in()) {
        $role = user()->getRoles();
        if (in_array('admin', $role)) {
            $t = 'primary';
        } else if (in_array('petugas', $role)) {
            $t = 'info';
        } else if (in_array('pengguna', $role)) {
            $t = 'success';
        } else {
            $t = 'danger';
        }

        return $t;
    } else {
        return '';
    }
}


// user themes hex color
function userColorHex()
{
    if (logged_in()) {
        $role = user()->getRoles();
        if (in_array('admin', $role)) { 
            $c = '#007bff';
        } else if (in_array('petugas', $role)) {
            $c = '#17a2b8';
        } else if (in_array('pengguna', $role)) {
            $c = '#28a745';
        } else {
            $c = '#dc3545';
        }

        return $c;
    } else {
        return '';
    }
}