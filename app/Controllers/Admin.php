<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Libraries\GroceryCrud;

class Admin extends BaseController
{
    public function index()
    {
        return redirect()->to('/admin/users'); // page par défaut
    }

    public function users()
    {
        $crud = new GroceryCrud();

        $crud->setTable('user');
        $crud->setSubject('Utilisateur', 'Utilisateurs');
        $crud->columns(['username', 'email', 'created_at']);
        $crud->requiredFields(['username', 'email']);

        $output = $crud->render();

        return view('admin_view', (array)$output);
    }

public function cvs()
{
    $crud = new GroceryCrud();

    $crud->setTable('cvs');
    $crud->setPrimaryKey('id', 'cvs');
    $crud->setSubject('CV', 'CVs');
    $crud->columns(['username', 'email', 'phone', 'filename', 'filepath', 'created_at']);
    $crud->displayAs('username', 'Utilisateur');
    $crud->displayAs('filename', 'Nom du fichier');
    $crud->displayAs('filepath', 'Fichier');
    $crud->displayAs('created_at', 'Date d\'upload');

    $crud->callbackColumn('filepath', function ($value, $row) {
        $url = site_url('admin/download_cv/' . $row->id);
        return "<a href='$url' target='_blank'>Télécharger / Visualiser</a>";
    });

    $crud->callbackBeforeDelete(function ($primaryKey) {
        $cvModel = new \App\Models\CVModel();
        $cv = $cvModel->find($primaryKey);
        if ($cv && file_exists(WRITEPATH . $cv['filepath'])) {
            unlink(WRITEPATH . $cv['filepath']);
        }
        return true;
    });

    $crud->unsetAdd();
    $crud->unsetEdit();

    $output = $crud->render();
    return view('admin_view', (array)$output);
}


    public function download_cv($id)
{
    // Récupère le cv
    $cvModel = new \App\Models\CVModel();
    $cv = $cvModel->find($id);

    if (!$cv) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $fullPath = WRITEPATH . $cv['filepath'];
    if (!file_exists($fullPath)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return $this->response->download($fullPath, null)
        ->setFileName($cv['filename']); // nom original pour le download
}

}
