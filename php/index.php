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

    static public function random()
    {
        return $randColors = new ValueObject(rand(0, 255), rand(0, 255), rand(0, 255));
    }
    }


    $colors = new ValueObject(255, 0,10);
$colors->random();
echo $randColors->getRed();
echo $randColors->getGreen();
echo $randColors->getBlue();
