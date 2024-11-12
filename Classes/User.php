<?php
namespace Classes;
class User
{
    private $name;
    private $email;
    private $age;

    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new MyExeption('Method ' . $name . ' does not exist');
        }
        return call_user_func_array([$this, $name], $arguments);

    }

    private function setName($name)
    {
        $this->name = $name;
        echo 'Name: ' . $name;
    }

    private function setAge($age)
    {
        $this->age = $age;
        echo 'Age: ' . $age;
    }

    public function getAll(): array
    {
        return [0 => $this->name, 1 => $this->age, 2 => $this->email];
    }

}