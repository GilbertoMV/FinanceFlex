<?php
interface IModel{
    /**Definir funciones - metodos */
    public function save();
    public function getAll();
    public function get($id);
    public function delete($id);
    public function update($id);
    public function from($array);
}
?>