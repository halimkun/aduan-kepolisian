<?php 
    function getJenisAduan($id)
    {
        $jenisModel = new \App\Models\JenisModel();
        return $jenisModel->find($id);
    }

    function getStatusAduan($id)
    {
        $statusModel = new \App\Models\StatusModel();
        return $statusModel->find($id);
    }