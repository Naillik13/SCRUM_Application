<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Table(name="article")
 */

class Article
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
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $date;


    const STATUS_PUBLISHED   = 0;
    const STATUS_UNPUBLISHED = 1;
    const STATUS_DRAFT       = 2;
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
     * @return Article
     *
     * @throws \Exception
     */
    public function setId(int $id): Article
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
     * @return Article
     *
     * @throws \Exception
     */
    public function setName(string $name): Article
    {
        if (empty($name)) {
            throw new \Exception("Article name cannot be empty.");
        }

        $this->name = $name;

        /* START Slug */
        $this->setSlug($name);

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     *
     * @return Article
     *
     * @throws \Exception
     */
    public function setStatus(int $status): Article
    {
        if (!in_array($status, self::getStatuses())) {
            throw new \Exception("Status value not valid");
        }

        $this->status = $status;

        return $this;
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_UNPUBLISHED,
            self::STATUS_PUBLISHED,
        ];
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
     * @return Article
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
     * @return string
     */
    public function getContent(): ?string
    {
        //utiliser substr($content, 0, -1) pour retourner un extrait
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Article
     *
     * @throws \Exception
     */
    public function setContent(string $content) : Article
    {
        if (empty($content)) {
            throw new \Exception("Article content cannot be empty.");
        }
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return Article
     */
    public function setDate(string $date) : Article
    {
        $this->date = $date;

        return $this;
    }






}
