<?php

namespace Weboloper\Volt;


class VoltFunctions
{
 
    public function compileFunction($name, $arguments)
    {
        if (function_exists($name)) {
            return $name . "(". $arguments . ")";
        }
        
        switch ($name) {
            case 'is_authorized':
                return true;
            case 'is_moderator':
                return '$this->auth->isModerator()';
            case 'is_admin':
                return '$this->auth->isAdmin()';
            case 'markdown':
                return \Weboloper\Utils\Markdown::class . "::create({$arguments})";
            // case 'vote_score':
            //     return 'container(' . Service\Vote::class . "::class)->getScore({$arguments})";
        }

        // $property = $name;
        // $class = '\Phanbook\Tools\ZFunction';

        // if (method_exists($class, $property)) {
        //     return $class . '::' . $property . '(' . $arguments . ')';
        // }
        // if (!$arguments) {
        //     // Get constant if exist
        //     if (defined($class . '::' . $property)) {
        //         return $class . '::' . $property;
        //     }

        //     // Get static property if exist
        //     if (property_exists($class, $property)) {
        //         return $class . '::$' . $property;
        //     }
        // }

        return null;
    }

    /**
     * Compile some filters
     *
     * @param string $name      The filter name
     * @param mixed  $arguments The filter args
     *
     * @return string|null
     */
    public function compileFilter($name, $arguments)
    {
        switch ($name) {
            case 'isset':
                return '(isset(' . $arguments . ') ? ' . $arguments . ' : false)';
            case 'long2ip':
                return 'long2ip(' . $arguments . ')';
            case 'teaser':
                return Functions\Teaser::class . '::create(' . $arguments . ')';
            case 'strlen':
                return "\\Stringy\\create('$arguments')->length()";
        }

        return null;
    }
}
