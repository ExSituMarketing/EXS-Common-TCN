<?php

namespace exs\TcnCommonBundle\Service\Manager;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;

/**
 * Class OpenSiteManager
 * @package exs\TcnCommonBundle\Service\Manager
 */
class OpenSiteManager
{
    /**
     * Sets the correct tourlink
     *
     * @param array|string $tourlinks String or array of tourlink
     * @param null $categorySlug
     * @return string
     */
    public function getTourlink($tourlinks, $categorySlug = null)
    {
        if (!is_array($tourlinks)) {
            return $tourlinks;
        }

        if ($categorySlug && $tourlinks[$categorySlug]) {
            return $tourlinks[$categorySlug];
        }

        // if the featured link is set, return that, else return homepage
        return ($tourlinks['featured']) ? $tourlinks['featured'] : null;
    }
}