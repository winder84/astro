<?php

namespace Wind\BookofdreamsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Word
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Word
{

	/**
	 * @ORM\ManyToMany(targetEntity="Text", mappedBy="words")
	 */
	private $texts;

	public function __construct() {
		$this->texts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return Word
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add texts
     *
     * @param \Wind\BookofdreamsBundle\Entity\Text $texts
     * @return Word
     */
    public function addText(\Wind\BookofdreamsBundle\Entity\Text $texts)
    {
        $this->texts[] = $texts;

        return $this;
    }

    /**
     * Remove texts
     *
     * @param \Wind\BookofdreamsBundle\Entity\Text $texts
     */
    public function removeText(\Wind\BookofdreamsBundle\Entity\Text $texts)
    {
        $this->texts->removeElement($texts);
    }

    /**
     * Get texts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTexts()
    {
        return $this->texts;
    }

	public function __toString()
	{
		return $this->name;
	}
}
