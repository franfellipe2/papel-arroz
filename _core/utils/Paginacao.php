<?php

namespace app\utils;

USE app\DB;
use app\models\Model;

/**
 * Description of Paginacao
 *
 * @author franf
 */
class Paginacao {

    private $pages;
    private $currentPage;
    private $totalPages;
    private $resultsPerPage;
    private $totalRegistros;
    private $totalLinks;
    private $model;
    private $limit;

    function __construct(Model $objt, $resultsPerPage, $totalLinks, $currentPage)
    {
        $this->model = $objt;
        $this->resultsPerPage = $resultsPerPage;
        $this->totalLinks = $totalLinks;
        $this->currentPage = $currentPage;
        $this->setTotalRegistros();
        $this->calcTotalPages();
        $this->setLimit();
    }

    public function draw($showTotals = false)
    {
        if ($this->getTotalPages() > 0) {
            echo '<nav aria-label="Page navigation example">';
            if ($showTotals) {
                echo "<h6>Mostrando {$this->getTotalResultsPerPage()}/{$this->getTotalRegistros()}<h6>";
            }
            echo '<ul class="pagination">';

            $this->getLinks(function($previous, $left, $current, $righ, $next) {
                if ($previous) {
                    echo '<li class="page-item"><a class="page-link" href="' . $previous . '">Anterior</a></li>';
                }
                foreach ($left as $l => $v) {
                    echo '<li class="page-item"><a class="page-link" href="' . $l . '">' . $v . '</a></li>';
                }
                echo '<li class="page-item active"><a class="page-link" href="' . $current[0] . '">' . $current[1] . '</a></li>';
                foreach ($righ as $l => $v) {
                    echo '<li class="page-item"><a class="page-link" href="' . $l . '">' . $v . '</a></li>';
                }
                if ($next) {
                    echo '<li class="page-item"><a class="page-link" href="' . $next . '">Próximo</a></li>';
                }
            });
            echo '</ul>';
            echo '</nav>';
        }
    }

    public function getTotalRegistros()
    {
        return $this->totalRegistros;
    }

    public function getTotalResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    public function getTotalPages()
    {
        return $this->totalPages;
    }

    public function getLinks($callback)
    {
        // Preservar as query strings
        $qs = ($q = $this->getQueryString()) ? '&' . $q : null;

        // Link para voltar
        $previous = ( $n = ($this->currentPage - 1)) > 0 ? '?paginate=' . $n . $qs : null;
        // Linkp ara proximo
        $next = ( $n = $this->currentPage + 1 ) <= $this->totalPages ? '?paginate=' . $n . $qs : null;

        // Links left        
        $linksLeft = array();
        for ($i = 0; $i < $this->totalLinks / 2; $i++) {
            $page = $this->currentPage - $i;
            if ($page > 0 && $page != $this->currentPage) {
                $linksLeft['?paginate=' . ($page) . $qs] = $page;
            }
        }
        // Currente link
        $currentLink = [('?paginate=' . ($this->currentPage) . $qs), $this->currentPage];
        // Links right        
        $linksRight = array();
        for ($i = 0; $i <= $this->totalLinks / 2; $i++) {
            $page = $this->currentPage + $i;            
            if ($page > $this->currentPage && $page <= $this->getTotalPages() ) {
                $linksRight['?paginate=' . ($page) . $qs] = $page;
            }
        }

        $callback($previous, array_reverse($linksLeft), $currentLink, $linksRight, $next);
    }

    private function getQueryString()
    {
        $query_data = array();
        if (isset($_SERVER['QUERY_STRING'])) {
            foreach (explode('&', $_SERVER['QUERY_STRING']) as $k) {
                $arr = explode('=', $k);
                if ($arr[0] != 'paginate' && isset($arr[1])) {
                    $query_data[$arr[0]] = $arr[1];
                }
            }
        }
        return http_build_query($query_data);
    }

    public function limit(): array
    {
        return $this->limit;
    }

    public function setLimit()
    {
        $this->limit = [$this->currentPage > 1 ? $this->currentPage - 1 : 0, $this->resultsPerPage];
    }

    private function calcTotalPages()
    {
        $this->totalPages = $this->totalRegistros > $this->resultsPerPage ? ceil($this->totalRegistros / $this->resultsPerPage) : 0;
    }

    private function setTotalRegistros()
    {
        $db = new DB();
        $r = $db->select('SELECT count(*) as total FROM ' . $this->model->getTable());
        $this->totalRegistros = isset($r[0]) ? $r[0]['total'] : 0;
    }
}
