<?php
require_once(__DIR__."/controllers/tareas.php");
require_once(__DIR__."/controllers/estado.php");
include_once('views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($action) {
    case 'new':
        $dataestado = $estado -> get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $cantidad = $tarea->new($data);
            if ($cantidad) {
                $tarea->flash('success', "Registro dado de alta con éxito");
                $data = $tarea->get();
                include('views/index.php');
            } else {
                $tarea->flash('danger', "Algo salió mal.");
                include('views/form.php');
            }
        } else {
            include('views/form.php');
        }
        break;
    case 'edit':
        $dataestado = $estado -> get();
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $id = $_POST['data']['id_tarea'];
            $cantidad = $tarea->edit($id, $data);
            if ($cantidad) {
                $tarea->flash('success', "Registro actualizado con éxito");
                $data = $tarea->get();
                include('views/index.php');
            } else {
                $tarea->flash('warning', "Algo falló o no hubo cambios");
                $data = $tarea->get();
                include('views/index.php');
            }
        } else {
            $data = $tarea->get($id);
            include('views/form.php');
        }
        break;
    case 'delete':
        $cantidad = $tarea->delete($id);
        if ($cantidad) {
            $tarea->flash('success', "Registro eliminado con éxito");
            $data = $tarea->get();
            include('views/index.php');
        } else {
            $tarea->flash('danger', "Algo fallo");
            $data = $tarea->get();
            include('views/index.php');
        }
        break;
    case 'get':
    default:
        $data = $tarea->get($id);
        include("views/index.php");
}
include_once('views/footer.php');
?>