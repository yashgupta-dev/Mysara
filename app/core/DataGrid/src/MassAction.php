<?php

namespace app\core\DataGrid\src;

use Exception;

/**
 * Initial implementation of the mass action class. Stay tuned for more features coming soon.
 */
class MassAction
{    
    /**
     * but_role
     *
     * @var array
     */
    private $but_role = ["submit-button", "button", "button-icon", "action"];
        
    /**
     * icon
     *
     * @var string
     */
    public $icon;
        
    /**
     * title
     *
     * @var string
     */
    public $title;
    
    /**
     * method
     *
     * @var string
     */
    public $method;
        
    /**
     * dispatch
     *
     * @var string
     */
    public $dispatch;
        
    /**
     * options
     *
     * @var array
     */
    public $options = [];    
    
    /**
     * type
     *
     * @var string
     */
    public $type = '';
        
    /**
     * class
     *
     * @var string
     */
    public $class = '';

    /**
     * Create a column instance.
     */
    public function __construct($icon, $title, $method, $dispatch, $type = 'action', $options = [], $class = '')
    {
        if (empty($options) && !in_array($type, $this->but_role)) {
            throw new Exception("passed <b>$type</b> parameter in <b>$title</b> action does not exists e.g " . implode(', ', $this->but_role), 1);
        }
        
        if (strpos(strtolower($class), 'cm-ajax') !== false) {
            throw new Exception("You can not use cm-ajax in mass actions", 1);
        }

        if(!empty($options) && !empty($dispatch)) {
            throw new Exception("You can not use dispatch in <b>$title</b> mass actions, if you are using options", 1);
        }

        if(!empty($options) && !empty($type)) {
            throw new Exception("You can not use <b>type</b> in <b>$title</b> mass actions, if you are using options", 1);
        }

        if(!empty($options)) {
            foreach ($options as $key => $value) {
                if(empty($value['type'])) {
                    throw new Exception("Type is missing from {$value['label']} option", 1);
                    break;
                } else {
                    if(!in_array($value['type'], ['update', 'delete', 'list'])) {
                        throw new Exception("Undefine Type {$value['label']} option", 1);
                        break;
                    }
                }
            }
        }

        $this->icon     = $icon;
        $this->title    = $title;
        $this->method   = $method;
        $this->dispatch = $dispatch;
        $this->options  = $options;
        $this->class    = $class;
        $this->type     = $type;
    }

    /**
     * Convert to an array.
     */
    public function toArray()
    {
        return [
            'icon'      => $this->icon,
            'title'     => $this->title,
            'method'    => $this->method,
            'dispatch'  => $this->dispatch,
            'options'   => $this->options,
            'class'     => $this->class,
            'type'      => $this->type,
        ];
    }
}
