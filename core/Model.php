<?php

namespace Core;

abstract class Model
{
    /**
     * resolve
     *
     * Resolves model data values against a set of rules
     * returning an array of error messages if validation failed
     * 
     * @param  mixed $protocol
     *
     * @return array
     */
    public function resolve($protocol) : array {        
        $errors = [];

        foreach ($protocol as $key => $item) {
            $value = $item['value'];
            
            foreach ($item['rules'] as $rule => $message) {
                switch ($rule) {
                    case 'required':
                        if (is_null($value) || $value === '') {
                            $errors[] = $message;
                        }
                        break;

                    case 'no-digits':
                        if (\preg_match("/[0-9]/", $value)) {
                            $errors[] = $message;
                        }
                        break;

                    case 'no-html':
                        if (\preg_match("/<.[^<>]*?>/", $value)) {
                            $errors[] = $message;
                        }
                        break;
                }
            }
        }

        return $errors;
    }
}