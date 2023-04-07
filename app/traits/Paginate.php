<?php

namespace app\traits;

use app\classes\Url;

trait Paginate
{
    protected $perPage;
    private $totalRecords;
    private $maxLinks = 4;

    private function currentPage()
    {
        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);

        return $page ?? 1;
    }

    private function offset()
    {
        return ($this->currentPage() * $this->perPage) - $this->perPage;
    }

    private function totalRecords()
    {
        $bind = $this->pdoStatement;

        $bind->execute();

        return $bind->rowCount();
    }

    private function totalPages()
    {
        return ceil($this->totalRecords() / $this->perPage);
    }

    protected function sqlPaginate()
    {
        return " limit {$this->perPage} offset {$this->offset()}";
    }

    private function link()
    {
        $url = new Url;

        $link = '?page=';

        // localhost:8888/noticia?page=
        return $url->getUrl() . $link;
    }

    // [1]<< - 1-2-3-4-5->>[20]

    private function preview()
    {
        $links = '';
        if ($this->currentPage() != 1) {
            $preview = ($this->currentPage() - 1);
            $links .= '<li><a href="' . $this->link() . '1"> [1] </a></li>';
            $links .= '<li><a href="' . $this->link() . $preview . '" aria-label="Previous"> <span aria-hidden="true">&laquo;</span></a></li>';
        }
    }

    private function next()
    {
        $links = '';
        if ($this->currentPage() != $this->totalPages()) {
            $next = ($this->currentPage() - 1);
            $links .= '<li><a href="' . $this->link() . $next . '" aria-label="Next"> <span aria-hidden="true">&raquo;</span></a></li>';
            $links .= '<li><a href="' . $this->link() . $this->totalPages() . '"> [' . $this->totalPages() . '] </a></li>';
        }
    }

    private function showLinks($i)
    {
        $class = ($i == $this->currentPage()) ? 'actual' : '';

        if ($i > 0 && $i <= $this->totalPages()) {
            return "<li><a href='" . $this->link() . $i . "' class=" . $class . ">{$i}</a></li>";
        }
    }

    public function links()
    {
        if ($this->totalPages() > 0) {
            $links = '<ul class="pagination">';
            $links .= $this->preview();

            for ($i = $this->currentPage() - $this->maxLinks; $i <= $this->currentPage() + $this->maxLinks ; $i++) {
                $links .= $this->showLinks($i);
            }

            $links .= $this->next();

            $links .= '</ul>';

            return $links;
        }
    }
}
