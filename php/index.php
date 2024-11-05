<?php
trait Trait1
{
    public function test(): int
    {
        return 1;
    }
}
trait Trait2
{
    public function test(): int
    {
        return 2;
    }
}
trait Trait3
{
    public function test(): int
    {
        return 3;
    }
}

class Test()
{
    use Trait1, Trait2, Trait3;

}