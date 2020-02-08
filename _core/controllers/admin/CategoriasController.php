<?php

namespace app\controllers\admin;

use app\interfaces\AdminControllerInterface;
use app\controllers\admin\AdminController;
use app\models\Categoria;
use app\utils\CategoriasAninhadas;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class CategoriasController extends AdminController implements AdminControllerInterface {

    private $page = 'Categorias';

    public function gerenciar()
    {
        $formAction = $this->pageAction('save');
        $categoria = new Categoria();
        $categoriasAninhadas = new CategoriasAninhadas();
        $categoriasAninhadas = $categoriasAninhadas->get();
        $erros = [];
        require $this->getPage() . '/adicionar-listar.php';
    }

    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $categoria = new Categoria();

        if (!empty($data = $categoria->getById($id))) {
            $categoria->setData($data);
        } else {
            header('Location: ' . $this->pageAction('gerenciar'));
            die();
        }

        if (!isset($_GET['confirmDelete'])) {
            $linkConfirm = '<a class="btn btn-sm btn-danger" href="' . $this->pageAction('delete', ['id' => $id, 'confirmDelete' => true]) . '">SIM</a>';
            $linkCancel = '<a class="btn btn-sm btn-success" href="' . $this->pageAction('gerenciar') . '">NÃO</a>';
            echo '<div class="alert alert-warning">Você deseja realmente deletar a categoria "' . $categoria->getNome() . '" ---->>>> ' . $linkConfirm . ' - ' . $linkCancel . '  </div>';
            return;
        }

        $categoria->delete();

        header('Location: ' . $this->pageAction('gerenciar'));
    }

    public function editar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $categoria = new Categoria();

        if (!empty($data = $categoria->getById($id))) {
            $categoria->setData($data);            
        }
        $formAction = $this->pageAction('save');
        $categoriasAninhadas = new CategoriasAninhadas();
        $categoriasAninhadas = $categoriasAninhadas->get();
        $erros = [];
        require $this->getPage() . '/editar-listar.php';
    }

    public function save()
    {
        $categoria = new Categoria();
        $categoria->setId(filter_input(INPUT_POST, 'id'));
        $categoria->setNome(filter_input(INPUT_POST, 'nome'));
        $categoria->setDescricao(filter_input(INPUT_POST, 'descricao'));
        $categoria->setPai(filter_input(INPUT_POST, 'cat_pai'));
        
        
        $categoria->save();

        if ($categoria->errorExistis()) {

            $formAction = $this->pageAction('save');
            $categoriasAninhadas = new CategoriasAninhadas();
            $categoriasAninhadas = $categoriasAninhadas->get();
            $erros = $categoria->getErrors();

            require $this->getPage() . '/editar-listar.php';
        } else {

            header('Location: ' . $this->pageAction('gerenciar'));

            die();
        }
    }

    public function getPage(): string
    {
        return $this->page;
    }
}
