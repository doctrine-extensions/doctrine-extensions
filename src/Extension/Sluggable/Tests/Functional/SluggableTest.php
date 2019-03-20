<?php

namespace DoctrineExtensions\Extension\Sluggable\Tests\Functional;

use DoctrineExtensions\Common\Metadata\Driver\AnnotationDriver;
use DoctrineExtensions\Common\Test\AbstractFunctionalTestCase;
use DoctrineExtensions\Extension\Sluggable\Listener\SluggableListener;
use DoctrineExtensions\Extension\Sluggable\Metadata\Driver\SluggableDriverExtension;
use DoctrineExtensions\Extension\Sluggable\Tests\Fixtures\Entity\SluggableEntity;

class SluggableTest extends AbstractFunctionalTestCase
{
    /**
     * @var SluggableEntity
     */
    private $entity;

    public function getUsedEntityFixtures(): array
    {
        return [
            SluggableEntity::class
        ];
    }

    public function getUsedExtensions(): array
    {
        return [
            new SluggableDriverExtension(),
        ];
    }

    public function getUsedEventSubscribers(): array
    {
        return [
            new SluggableListener(),
        ];
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->entity = new SluggableEntity();
        $this->entity
            ->setTitle('Clean Code')
            ->setSubtitle('A Handbook of Agile Software Craftsmanship')
        ;
    }

    public function testSimpleSlug()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('clean-code', $this->entity->getSimple());
    }

    public function testMultipleSlug()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('clean-code-a-handbook-of-agile-software-craftsmanship', $this->entity->getMultiple());
    }

    public function testReverseSlug()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('a-handbook-of-agile-software-craftsmanship-clean-code', $this->entity->getReverse());
    }

    public function testSeparator()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('clean+code+a+handbook+of+agile+software+craftsmanship', $this->entity->getSeparator());
    }

    public function testGlue()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('clean-code: a-handbook-of-agile-software-craftsmanship', $this->entity->getGlue());
    }

    public function testCallback()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->assertEquals('this-is-a-custom-slug', $this->entity->getCallback());
    }

    public function testUpdate()
    {
        $this->em->persist($this->entity);
        $this->em->flush();

        $this->entity->setSubtitle('Whatever');

        $this->em->flush();

        $this->assertEquals('clean-code: whatever', $this->entity->getGlue());
    }
}
