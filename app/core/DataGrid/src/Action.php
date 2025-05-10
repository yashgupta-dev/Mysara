<?php

namespace app\core\DataGrid\src;

/**
 * Initial implementation of the action class. Stay tuned for more features coming soon.
 */
class Action
{    
    /**
     * index
     *
     * @var string
     */
    public $index;    
    
    /**
     * icon
     *
     * @var mixed
     */
    public $icon;
        
    /**
     * title
     *
     * @var mixed
     */
    public $title;
        
    /**
     * method
     *
     * @var mixed
     */
    public $method;
        
    /**
     * url
     *
     * @var mixed
     */
    public $url;

    /**
     * class
     *
     * @var mixed
     */
    public $class;

    /**
     * type
     *
     * @var mixed
     */
    public $type;

    protected $btn_type = ['list', 'delete'];

    /**
     * Create a column instance.
     */
    public function __construct($index, $icon, $title, $method, $url, $class = '', $type = 'list')
    {
        if(!empty($type) && !in_array($type, $this->btn_type)) {
            throw new \Exception('Invalid button type');
        }
        
        $this->index    = $index;
        $this->icon     = $icon;
        $this->title    = $title;
        $this->method   = $method;
        $this->url      = $url;
        $this->class    = $class;
        $this->type     = $type;
    }

    /**
     * Convert to an array.
     */
    public function toArray()
    {
        return [
            'index'  => $this->index,
            'icon'   => $this->icon,
            'title'  => $this->title,
            'class'  => $this->class,
            'method' => $this->method,
            'url'    => $this->url,
            'type'   => $this->type,
        ];
    }
}
