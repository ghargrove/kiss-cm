<?php

namespace kiss\base;

class Controller {
    
    public $args;
    public $view;
    public $scope;
    public $action;
    public $params;
    public $layout;
    public $content;
    public $controller;
    
    
    //set in the controller to disable to the view
    public $disable_view;
    public $disable_layout;
    
    public $scripts = array();
    public $styles = array();
    
    
    public function init() {
    }    
    
    public function initProps(array $values) {
        
        foreach( $values as $k=>$v ) {
            $this->$k = $v;
        }
        
        return $this; 
    }
    
    public function getMvc() {
         return $this;
    }
    
    public function _asJson(array $array,$disable_view = true, $disable_layout = true) {
       
       $this->disable_layout = $disable_layout;
       $this->disable_view = $disable_view;  
       
       return json_encode($array);
    }
    
    public function setScript($path) {
        
        $this->scripts[] = $path;
        return true;
    }
    
    public function getScripts() {
        $tags = '';
        foreach($this->scripts as $k=>$s) {
            
            $tags .= "<script type='text/javascript' src='{$s}'></script>\n";
        }
        return $tags;
    }
    
    public function setStyle($path) {
        
        $this->styles[] = $path;
        return true;
        
    }
    
    public function getStyles() {
        
        $tags = '';
        foreach($this->scripts as $k=>$s) {
            
            $tags .= "<link rel='stylesheet' href='{$s}'>\n";
        }
        
        return $tags;
    }
    
    /*
     * Return if the requert is xhr
     * @return<bool>
    */
    public function _isXhr()  {
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        
        return false;

    }
    
    
}