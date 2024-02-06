<?php //src/Entity/Radio.php

namespace App\Entity;

use App\Entity\Post;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RadioRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

#[ORM\Entity(repositoryClass: RadioRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'post_type', type: 'string')]
#[DiscriminatorMap(['post' => Post::class, 'radio' => Radio::class])]
class Radio extends Post
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $YouTubeUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $MixcloudUrl = null;

    public function getYouTubeURL(): ?string
    {
        return $this->YouTubeUrl;
    }

    public function setYouTubeURL(?string $YouTubeUrl): static
    {
        $this->YouTubeUrl = $YouTubeUrl;

        return $this;
    }

    public function getMixcloudUrl(): ?string
    {
        return $this->MixcloudUrl;
    }

    public function setMixcloudUrl(?string $MixcloudUrl): static
    {
        $this->MixcloudUrl = $MixcloudUrl;

        return $this;
    }
}
