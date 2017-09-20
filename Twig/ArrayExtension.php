<?php

namespace exs\TcnCommonBundle\Twig;

/**
 * Class DataExtension
 *
 * @package Exsitu\TcnCommonBundle\Service
 */
class ArrayExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('shuffle', [$this, 'shuffleArray']),
        ];
    }

    /**
     * @param string $tourlink
     *
     * @return string
     */
    public function shuffleArray($array)
    {
        if ($array instanceof \Traversable) {
            $array = iterator_to_array($array, false);
        }
        shuffle($array);
        return $array;
    }

    /**
     * Returns the extension name.
     *
     * @return string
     */
    public function getName()
    {
        return 'frameset_extension';
    }
}
