<?php
use vadimushka_d\NameList\GetNameList;
use PHPUnit\Framework\TestCase;

class GetNameListTest extends TestCase
{

    public function test_get_russian_male_names()
    {
        $GetNameList = new GetNameList(10,'ru');
        $names = $GetNameList->getMaleNames();
        $this->assertCount(10, $names);
        $this->assertInstanceOf(\vadimushka_d\NameList\Name::class, $names[0]);
    }

    public function test_get_russian_female_names()
    {

        $GetNameList = new GetNameList(10,'ru');
        $names = $GetNameList->getFemaleNames();
        $this->assertCount(10, $names);
        $this->assertInstanceOf(\vadimushka_d\NameList\Name::class, $names[0]);
    }

}
