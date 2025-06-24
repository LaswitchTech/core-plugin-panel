<?php

/**
 * Core Framework - PanelHelper
 *
 * @license    MIT (https://mit-license.org/)
 * @author     Louis Ouellet <louis@laswitchtech.com>
 */

// Import additionnal class into the global namespace
use \LaswitchTech\Core\Abstracts\Helper;

class PanelHelper extends Helper {

    /**
     * Render menu
     *
     * @param array $items
     * @return string
     */
    public function menu(array $items): string
    {
        $html = '<ul class="nav nav-pills flex-column">';
        foreach($items as $route => $item) {
            $html .= $this->item($route, $item, 1);
        }
        $html .= '</ul>';

        return $html;
    }

    /**
     * Render menu item
     *
     * @param string $id
     * @param array $menu
     * @param int $level
     * @return string
     */
    private function item(string $id, array $menu, int $level): string
    {

        // Import Global Variables
        global $LOCALE;

        $label = $menu['label'];
        $icon = $menu['icon'];
        $link = $menu['link'];
        $items = $menu['items'];

        if ($level == 1) {
            $html = '<li class="nav-item">';
        } else {
            $html = '<li class="nav-item ps-2">';
        }
        if (count($items) > 0) {
            $html .= '<button class="nav-link w-100 text-start" data-route="'.$link.'" data-bs-toggle="collapse" data-bs-target="#menu'. str_replace('/','-',$link) .'-'.$level.'" role="button" aria-expanded="false" aria-controls="menu'. str_replace('/','-',$link) .'-'.$level.'"><i class="bi bi-'. $icon .' me-1"></i><span class="">'. $label .'</span></button>';
            $html .= '<div class="collapse" id="menu'. str_replace('/','-',$link) .'-'.$level.'"><ul class="nav nav-pills flex-column">';
            foreach($items as $route => $item) {
                $html .= $this->item($route, $item, $level + 1);
            }
            $html .= '</ul></div>';
        } else {
            $html .= '<a class="nav-link" href="'.$link.'"><i class="bi bi-'.$icon.' me-1"></i><span class="">'. $LOCALE->get($label) .'</span></a>';
        }
        $html .= '</li>';
        return $html;
    }

    /**
     * Render breadcrumbs
     *
     * @return string
     */
    public function crumbs(): string
    {
        // Import Global Variables
        global $LOCALE, $BUILDER;

        // Initialize the variables
        $html = '';
        foreach($BUILDER->crumbs() as $crumb){
            $html .= '<a class="nav-link" href="' . $crumb['link'] . '">';
            $html .= '<i class="me-1 bi bi-' . $crumb['icon'] . '"></i>';
            $html .= '<span class="brand">' . $LOCALE->get($crumb['label']) . '</span>';
            $html .= '</a>';
        }

        return $html;
    }
}
