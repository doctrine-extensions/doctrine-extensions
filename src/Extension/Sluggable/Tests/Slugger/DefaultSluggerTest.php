<?php

namespace DoctrineExtensions\Extension\Sluggable\Tests\Slugger;

use DoctrineExtensions\Common\Exception\UndefinedPropertyException;
use DoctrineExtensions\Extension\Sluggable\Slugger\DefaultSlugger;
use DoctrineExtensions\Extension\Sluggable\Tests\Fixtures\Entity\SluggableEntity;
use PHPUnit\Framework\TestCase;

class DefaultSluggerTest extends TestCase
{
    private $entity;

    public function setUp(): void
    {
        $entity = $this->createMock(SluggableEntity::class);
        $entity->method('getTitle')->willReturn('Clean Code');
        $entity->method('getSubtitle')->willReturn('A Handbook of Agile Software Craftsmanship');

        $this->entity = $entity;
    }

    function testTransliteration()
    {
        $slugger = new DefaultSlugger();
        $slug = $slugger($this->entity, ['title', 'subtitle'], '-');

        $this->assertEquals('clean-code-a-handbook-of-agile-software-craftsmanship', $slug);
    }

    function testGlue()
    {
        $slugger = new DefaultSlugger();
        $slug = $slugger($this->entity, ['title', 'subtitle'], '-', ': ');

        $this->assertEquals('clean-code: a-handbook-of-agile-software-craftsmanship', $slug);
    }

    function testUndefinedPropertyException()
    {
        $this->expectException(UndefinedPropertyException::class);

        $slugger = new DefaultSlugger();
        $slugger($this->entity, ['title', 'imNotReal'], '-', ': ');
    }
}
