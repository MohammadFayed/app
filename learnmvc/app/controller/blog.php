<?php 
namespace controller;

class blog extends abstractController
{
    public function default()
    {
        echo "you are in blog controller and defualt method";
    }
    public function add($id)
    {
        echo "you are in blog controller and Add method and id = ". $id;
    }

}

?>