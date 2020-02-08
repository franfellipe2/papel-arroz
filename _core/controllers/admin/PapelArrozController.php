<?php

namespace app\controllers\admin;

use app\interfaces\AdminControllerInterface;
use app\controllers\admin\AdminController;
use app\models\PapelArroz;
use app\utils\CategoriasAninhadas;
use app\utils\Images;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class PapelArrozController extends AdminController implements AdminControllerInterface {

    private $page = 'PapelArroz';

    /**
     * 
     */
    public function adicionar()
    {
        $formAction = $this->pageAction('save');
        $papelArroz = new PapelArroz();
        $categoriasAninhadas = new CategoriasAninhadas();
        $erros = [];
        require $this->getPage() . '/adicionar.php';
    }

    /**
     * 
     */
    public function listar()
    {
        $papelArroz = new PapelArroz();
        require $this->page . '/listar.php';
    }

    /**
     * 
     * @return type
     */
    public function delete()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $papelArroz = new PapelArroz();

        if (!$papelArroz->getById($id)) {           
            header('Location: ' . $this->pageAction('listar'));
            die();
        }

        if (!isset($_GET['confirmDelete'])) {
            $linkConfirm = '<a class="btn btn-sm btn-danger" href="' . $this->pageAction('delete', ['id' => $id, 'confirmDelete' => true]) . '">SIM</a>';
            $linkCancel = '<a class="btn btn-sm btn-success" href="' . $this->pageAction('listar') . '">NÃO</a>';
            echo '<div class="alert alert-warning">Você deseja realmente deletar a categoria "' . $papelArroz->getTitulo() . '" ---->>>> ' . $linkConfirm . ' - ' . $linkCancel . '  </div>';
            return;
        }

        $img = $papelArroz->getImagem();
        $papelArroz->delete();

        Images::remove($img);

        header('Location: ' . $this->pageAction('listar'));
    }

    /**
     * 
     */
    public function editar()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $papelArroz = new PapelArroz();
        if (!$papelArroz->getById($id)) {
            echo '<h1 class="alert alert-warning">Opss.. Arquivo não encontrado!</h1>';
        } else {
            $formAction = $this->pageAction('update', ['id' => $id]);
            $categoriasAninhadas = new CategoriasAninhadas();
            require $this->getPage() . '/editar.php';
        }
    }

    /**
     * 
     */
    public function update()
    {


        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $papelArroz = new PapelArroz();
        if (!$id || $papelArroz->getById($id) == false) {
            header('Location: ' . $this->pageAction('adicionar'));
            die();
        }
        $papelArroz->setId($id);
        $papelArroz->setTitulo(filter_input(INPUT_POST, 'titulo'));
        $papelArroz->setDescricao(filter_input(INPUT_POST, 'descricao'));
        $papelArroz->setCategoria(filter_input(INPUT_POST, 'cat_id'));
        $papelArroz->setPreco(str_replace(',', '.', filter_input(INPUT_POST, 'preco')));
        
        $papelArroz->save();

        if ($papelArroz->errorExistis()) {

            $formAction = $this->pageAction('save');
            $erros = $papelArroz->getErrors();

            require $this->getPage() . '/editar.php';
        } else {


            $img = $_FILES['imagem'];
            $imgName = $img['name'];
            if ($imgName) {
                $upload = new Images();
                $upload::remove($papelArroz->getImagem());
                $path = $upload->upload($img, appStrSlug($papelArroz->getTitulo()) . time());
                $papelArroz->setImagem($path);
                $papelArroz->save();
            }


            $_SESSION['msg_success'] = 'Atualizado com sucesso!';
            header('Location: ' . $this->pageAction('editar', ['id' => $papelArroz->getId()]));

            die();
        }
    }

    /**
     * 
     */
    public function save()
    {

        $imagem = $_FILES['imagem'];
        $imgName = null;
        if (!empty($imagem['name'])) {
            $imgName = substr($imagem['name'], 0, strrpos($imagem['name'], '.'));
            $imgName .= '-' . time();
        }

        $imgUp = new Images();
        $imagPath = $imgUp->upload($imagem, $imgName);

        $papelArroz = new PapelArroz();
        $papelArroz->setId(filter_input(INPUT_POST, 'id'));
        $papelArroz->setTitulo(filter_input(INPUT_POST, 'titulo'));
        $papelArroz->setDescricao(filter_input(INPUT_POST, 'descricao'));
        $papelArroz->setCategoria(filter_input(INPUT_POST, 'cat_id'));
        $papelArroz->setPreco(str_replace(',', '.', filter_input(INPUT_POST, 'preco')));
        $papelArroz->setImagem($imagPath);
        

        $papelArroz->save();

        if ($papelArroz->errorExistis()) {

            $formAction = $this->pageAction('save');
            $erros = $papelArroz->getErrors();

            // Deleta as imagens enviadas
            $imgUp::remove($imagPath);

            $categoriasAninhadas = new CategoriasAninhadas();

            require $this->getPage() . '/adicionar.php';
        } else {

            header('Location: ' . $this->pageAction('editar', ['id' => $papelArroz->getId()]));

            die();
        }
    }

    /**
     * 
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }
}
