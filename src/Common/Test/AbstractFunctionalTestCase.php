<?php

namespace DoctrineExtensions\Common\Test;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\SchemaTool;
use DoctrineExtensions\Common\Metadata\Driver\ExtensionDriver;
use DoctrineExtensions\Common\Metadata\ExtendedClassMetadataFactory;
use PHPUnit\Framework\TestCase;

abstract class AbstractFunctionalTestCase extends TestCase
{
    /**
     * @var EntityManager
     */
    protected $em;

    public function setUp(): void
    {
        $reader = new AnnotationReader();
        $driver = new ExtensionDriver(new AnnotationDriver($reader), $reader);

        foreach ($this->getUsedExtensions() as $extension) {
            $driver->addExtension($extension);
        }

        $config = new Configuration();
        $config->setProxyDir(__DIR__ . '/../../temp');
        $config->setProxyNamespace('Proxy');
        $config->setMetadataDriverImpl($driver);
        $config->setClassMetadataFactoryName(ExtendedClassMetadataFactory::class);

        $conn = [
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ];

        $em = EntityManager::create($conn, $config);

        foreach ($this->getUsedEventSubscribers() as $eventSubscriber) {
            $em->getEventManager()->addEventSubscriber($eventSubscriber);
        }

        $schema = array_map(function ($class) use ($em) {
            return $em->getClassMetadata($class);
        }, (array) $this->getUsedEntityFixtures());

        $schemaTool = new SchemaTool($em);
        $schemaTool->dropSchema(array());
        $schemaTool->createSchema($schema);

        $this->em = $em;
    }

    abstract public function getUsedEntityFixtures(): array;
    abstract public function getUsedExtensions(): array;
    abstract public function getUsedEventSubscribers(): array;
}
