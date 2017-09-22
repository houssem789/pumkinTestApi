<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:14
 */

namespace AppBundle\Entity\User;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Security\Core\User\UserInterface;

use AppBundle\Entity\Transaction\Transaction;

/**
 * Class User
 * @package AppBundle\Entity\User
 *
 * @ORM\Entity
 * @ORM\Table(name="puser")
*/
class User extends AbstractUser
{
    /**
     * User Id
     *
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Security\IdGenerator")
     */
    protected $id;

    /**
     * User pseudo (nullable)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pseudo;

    /**
     * User plain password (not store in database)
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * User password
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * User PIN
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pin;

    /**
     * User plain PIN (not store in database)
     *
     * @var string
     */
    protected $plainPin;

    /**
     * User salt
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $salt;

    /**
     * User salt PIN
     *
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $saltPin;

    /**
     * User Facebook Id (nullable, unique)
     *
     * @var string
     * @ORM\Column(type="string", nullable=true, unique=true)
     */
    protected $facebookId;

    /**
     * User credited transactions collection
     *
     * @var ArrayCollection<Transaction>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transaction\Transaction", mappedBy="creditedPerson", cascade={"persist"})
     */
    protected $creditedTransactions;

    /**
     * User debited transactions collection
     *
     * @var ArrayCollection<Transaction>
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transaction\Transaction", mappedBy="debitedPerson", cascade={"persist"})
     */
    protected $debitedTransactions;

    /**
     * User constructor.
     */
    function __construct()
    {
        parent::__construct();

        $this->roles = array('ROLE_USER');

//        $this->nationality = "FR";
//        $this->country = "FR";

        $this->creditedTransactions = new ArrayCollection();
        $this->debitedTransactions = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPin()
    {
        return $this->pin;
    }

    /**
     * @param string $pin
     */
    public function setPin($pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return string
     */
    public function getPlainPin()
    {
        return $this->plainPin;
    }

    /**
     * @param string $plainPin
     */
    public function setPlainPin($plainPin)
    {
        $this->plainPin = $plainPin;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getSaltPin()
    {
        return $this->saltPin;
    }

    /**
     * @param string $saltPin
     */
    public function setSaltPin($saltPin)
    {
        $this->saltPin = $saltPin;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return ArrayCollection
     */
    public function getCreditedTransactions()
    {
        return $this->creditedTransactions;
    }

    /**
     * @param ArrayCollection $creditedTransactions
     */
    public function setCreditedTransactions(ArrayCollection $creditedTransactions)
    {
        $this->creditedTransactions = $creditedTransactions;
    }

    /**
     * @param Transaction $transaction
     */
    public function addCreditedTransaction(Transaction $transaction)
    {
        if ($this->creditedTransactions->contains($transaction) === false) {
            $this->creditedTransactions->add($transaction);
            if ($transaction->getCreditedPerson() === null) {
                $transaction->setCreditedPerson($this);
            }
        }
    }

    /**
     * @return ArrayCollection
     */
    public function getDebitedTransactions()
    {
        return $this->debitedTransactions;
    }

    /**
     * @param ArrayCollection $debitedTransactions
     */
    public function setDebitedTransactions(ArrayCollection $debitedTransactions)
    {
        $this->debitedTransactions = $debitedTransactions;
    }

    /**
     * @param Transaction $transaction
     */
    public function addDebitedTransaction(Transaction $transaction)
    {
        if ($this->debitedTransactions->contains($transaction) === false) {
            $this->debitedTransactions->add($transaction);
            if ($transaction->getDebitedPerson() === null) {
                $transaction->setDebitedPerson($this);
            }
        }
    }
}