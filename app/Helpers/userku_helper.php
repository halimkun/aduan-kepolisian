<?php 
    function getUserName($id) {
        $user = new \App\Models\UserModel();
        $user = $user->find($id);
        return $user->nama;
    }