<?php

class ValueObject
{
    private int $red;
    private int $green;
    private int $blue;

    public function __construct(int $red, int $green, int $blue)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);

    }

    public function setRed(int $red): void
    {
        if ($red >= 0 and $red <= 255)
            $this->red = $red;
        else throw new Exception('value must be between 0 and 255');
    }

    public function setGreen(int $green): void
    {
        if ($green >= 0 and $green <= 255)
            $this->green = $green;
        else throw new Exception('value must be between 0 and 255');
    }

    public function setBlue(int $blue): void
    {
        if ($blue >= 0 and $blue <= 255)
            $this->blue = $blue;
        else throw new Exception('value must be between 0 and 255');
    }

    public function getRed(): int
    {
        return $this->red;
    }

    public function getGreen(): int
    {
        return $this->green;
    }

    public function getBlue(): int
    {
        return $this->blue;
    }

    public function equals(ValueObject $object): bool
    {
        return $this->red === $object->getRed()
            && $this->green === $object->getGreen()
            && $this->blue === $object->getBlue();
    }

    static public function random(): ValueObject
    {
        return new ValueObject(rand(0, 255), rand(0, 255), rand(0, 255));
    }

    public function mix(ValueObject $object)
    {

        $red = ($this->red + $object->getRed()) / 2;
        $green = ($this->green + $object->getGreen()) / 2;
        $blue = ($this->blue + $object->getBlue()) / 2;
        return new ValueObject($red, $green, $blue);
    }
}


$colors1 = new ValueObject(100, 150, 50);
$colors2 = new ValueObject(100, 100, 50);
$mixcol = $colors1->mix($colors2);

echo '<br>';
var_dump($mixcol->getRed());
echo '<br>';
var_dump($mixcol->getGreen());
echo '<br>';
var_dump($mixcol->getBlue());