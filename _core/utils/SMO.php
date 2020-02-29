<?php

namespace app\utils;

/**
 * Otimização do site para midias sociais
 *
 * @author franf
 */
class SMO {

    private $url;
    private $image;
    private $imageAlt;
    private $imageWith;
    private $imageHeight;
    private $title;
    private $description;
    private $type;
    private $locale = 'pt_BR';
    private $tags = "\n";

    function __construct($url, $image, $imageAlt, $title, $description, $type)
    {
        $this->url = $url;
        $this->image = $image;
        $this->imageAlt = $imageAlt;
        if ($image) {
            list($largura, $altura) = getimagesize( appConfig('baseDir') . substr($image, strlen(appConfig('baseUrl'))));
            $this->imageWith = $largura;
            $this->imageHeight = $altura;
        }
        $this->title = $title;
        $this->description = $description;
        $this->type = $type;
    }

    public function mount()
    {
        $this->mountOpenGraph();
        return $this->tags;
    }

    /**
     * O protocolo Open Graph permite que qualquer página da Web se torne um objeto rico em um gráfico social. Por exemplo, isso é usado no Facebook para permitir que qualquer página da Web tenha a mesma funcionalidade que qualquer outro objeto no Facebook.
     */
    private function mountOpenGraph()
    {
        $this->addTag('og:title', $this->title);
        $this->addTag('og:url', $this->url);
        $this->addTag('og:image', $this->image);
        $this->addTag('og:image:secure_url', $this->image);
        $this->addTag('og:image:alt', $this->imageAlt);
        $this->addTag('og:image:width', $this->imageWith);
        $this->addTag('og:image:height', $this->imageHeight);
        $this->addTag('og:type', $this->type);
        $this->addTag('og:description', $this->description);
        $this->addTag('og:locale', $this->locale);
    }

    private function addTag($type, $value)
    {
        $this->tags .= "<meta  property=\"$type\" content=\"$value\">\n";
    }
}
