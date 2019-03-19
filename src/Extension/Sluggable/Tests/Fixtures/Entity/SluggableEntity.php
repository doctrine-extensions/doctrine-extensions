<?php

namespace DoctrineExtensions\Extension\Sluggable\Tests\Fixtures\Entity;

use Doctrine\ORM\Mapping as ORM;
use DoctrineExtensions\Extension\Sluggable\Annotation\Sluggable;

/**
 * @ORM\Entity()
 */
class SluggableEntity
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"title"})
     */
    private $simple;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"title", "subtitle"})
     */
    private $multiple;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"subtitle", "title"})
     */
    private $reverse;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"title", "subtitle"}, separator="+")
     */
    private $separator;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"title", "subtitle"}, glue=": ")
     */
    private $glue;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Sluggable(fields={"title", "subtitle"}, callback={SluggableEntity::class, "slugHandler"})
     */
    private $callback;

    public static function slugHandler(object $entity, array $fields, string $separator, ?string $glue = null): string
    {
        return 'this-is-a-custom-slug';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getSimple(): ?string
    {
        return $this->simple;
    }

    public function setSimple(?string $simple): self
    {
        $this->simple = $simple;

        return $this;
    }

    public function getMultiple(): ?string
    {
        return $this->multiple;
    }

    public function setMultiple(?string $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    public function getReverse(): ?string
    {
        return $this->reverse;
    }

    public function setReverse(?string $reverse): self
    {
        $this->reverse = $reverse;

        return $this;
    }

    public function getSeparator(): ?string
    {
        return $this->separator;
    }

    public function setSeparator(?string $separator): self
    {
        $this->separator = $separator;

        return $this;
    }

    public function getGlue(): ?string
    {
        return $this->glue;
    }

    public function setGlue(?string $glue): self
    {
        $this->glue = $glue;

        return $this;
    }

    public function getCallback(): ?string
    {
        return $this->callback;
    }

    public function setCallback(?string $callback): self
    {
        $this->callback = $callback;

        return $this;
    }
}
