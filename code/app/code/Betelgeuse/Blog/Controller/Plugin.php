<?php
namespace Betelgeuse\Blog\Controller;

/**
 * Class Plugin
 *
 * @package Betelgeuse\Blog\Controller
 */
class Plugin {

    /**
     * @param $subject
     * @param $a
     * @param $b
     * @param $c
     * @return int[]
     */
    public
    function beforePlugin($subject, $a, $b, $c) {
        $a++;
        $b++;
        $c--;

        return [$a, $b, $c];
    }

    /**
     * @param $subject
     * @param $proceed
     * @param mixed ...$args
     * @return int
     */
    public
    function aroundPlugin($subject, $proceed, ...$args) {
        return $proceed(...$args) + 10;
    }

    /**
     * @param $subject
     * @param $result
     * @return float|int
     */
    public
    function afterPlugin($subject, $result) {
        return $result / 2;
    }
}
