<?php

namespace App\Entity;

use App\Repository\RedditPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RedditPostRepository::class)
 */
class RedditPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=RedditAuthor::class, inversedBy="posts")
     */
    private $redditAuthor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRedditAuthor(): ?RedditAuthor
    {
        return $this->redditAuthor;
    }

    public function setRedditAuthor(?RedditAuthor $redditAuthor): self
    {
        $this->redditAuthor = $redditAuthor;

        return $this;
    }
}
