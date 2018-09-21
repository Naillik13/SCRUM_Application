<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 * @ORM\Table(name="document")
 */

class Document
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
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $file;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $type;

    const MAX_PER_PAGE       = 10;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Document
     *
     * @throws \Exception
     */
    public function setId(int $id): Document
    {
        // Throwable
        // -> Error
        // -> Exception
        if ($id < 1) {
            throw new \Exception("Invalid value, id must be >= 1"); //on met un antislash devant l'exception car on sort du namespace
        }

        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Document
     *
     * @throws \Exception
     */
    public function setName(string $name): Document
    {
        if (empty($name)) {
            throw new \Exception("Document name cannot be empty.");
        }

        $this->name = $name;

        /* START Slug */
        $this->setSlug($name);

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Document
     *
     * @throws \Exception
     */
    public function setSlug($slug)
    {

        $slugify = new Slugify();
        $this->slug = $slugify->slugify($slug);

        return $this;
    }


    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @return User
     * @param User $id
     */
    public function setUser($id): Document
    {
        $this->user = $id;

        return $this;
    }


    /**
     * @return string
     */
    public function getFile(): ?string
    {
        //utiliser substr($content, 0, -1) pour retourner un extrait
        return $this->file;
    }

    /**
     * @param string $file
     *
     * @return Document
     *
     * @throws \Exception
     */
    public function setFile(string $file) : Document
    {
        if (empty($file)) {
            throw new \Exception("Document content cannot be empty.");
        }
        $this->file = $file;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Document
     */
    public function setType(string $type) : Document
    {
        $this->type = $type;

        return $this;
    }






}
