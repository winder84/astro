<?php

namespace Wind\BookofdreamsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Text
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Text
{

	/**
	 * @ORM\ManyToMany(targetEntity="Word", inversedBy="texts")
	 */
	private $words;

	/**
	 * @ORM\ManyToMany(targetEntity="Tag", inversedBy="texts")
	 */
	private $tags;

	public function __construct() {
		$this->words = new \Doctrine\Common\Collections\ArrayCollection();
		$this->tags = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Text
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Add words
     *
     * @param \Wind\BookofdreamsBundle\Entity\Word $words
     * @return Text
     */
    public function addWord(\Wind\BookofdreamsBundle\Entity\Word $words)
    {
        $this->words[] = $words;

        return $this;
    }

    /**
     * Remove words
     *
     * @param \Wind\BookofdreamsBundle\Entity\Word $words
     */
    public function removeWord(\Wind\BookofdreamsBundle\Entity\Word $words)
    {
        $this->words->removeElement($words);
    }

    /**
     * Get words
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * Add tags
     *
     * @param \Wind\BookofdreamsBundle\Entity\Tag $tags
     * @return Text
     */
    public function addTag(\Wind\BookofdreamsBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Wind\BookofdreamsBundle\Entity\Tag $tags
     */
    public function removeTag(\Wind\BookofdreamsBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
