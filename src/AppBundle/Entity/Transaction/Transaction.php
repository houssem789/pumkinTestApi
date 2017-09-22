<?php
/**
 * Created by PhpStorm.
 * User: pierrick
 * Date: 20/06/2017
 * Time: 11:42
 */

namespace AppBundle\Entity\Transaction;


use AppBundle\Entity\User\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Transaction
 * @package AppBundle\Entity\Transaction
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Transaction\TransactionRepository")
 * @ORM\Table(name="abstract_transaction")
 */
class Transaction
{
    /**
     * Transaction Id
     *
     * @ORM\Id
     * @ORM\Column(type="string", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Security\IdGenerator")
     */
    protected $id;

    /**
     * Transaction Owner
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", cascade={"persist"})
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    protected $owner;

    /**
     * Transaction status
     *
     * @var string
     * @ORM\Column(type="string")
     */
    protected $transactionStatus;

    /**
     * Transaction type (nullable)
     *
     * @var integer
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $transactionType;

    /**
     * Transaction amount (in cents)
     *
     * @var int
     * @ORM\Column(type="bigint", options={"default":0})
     */
    protected $amount;


    /**
     * Transaction currency (length 3)
     *
     * @var string
     * @ORM\Column(type="string", length=3)
     */
    protected $currency;

    /**
     * Transaction credited funds (in cents, nullable)
     *
     * @var int
     * @ORM\Column(type="bigint", nullable=true)
     */
    protected $creditedFunds;

    /**
     * Transaction debited funds (in cents)
     *
     * @var int
     * @ORM\Column(type="bigint", options={"default":0})
     */
    protected $debitedFunds;

    /**
     * Transaction visibility
     *
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $visibility;

    /**
     * Parent transaction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Transaction\Transaction", inversedBy="subTransactions", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_transaction_id", referencedColumnName="id")
     */
    protected $parentTransaction;

    /**
     * Children transactions
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Transaction\Transaction", mappedBy="parentTransaction", cascade={"persist"})
     */
    protected $subTransactions;

    /**
     * Transaction processed
     *
     * @var bool
     * @ORM\Column(type="boolean", options={"default":false})
     */
    protected $isProcessed;

    /**
     * Transaction credited user
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="creditedTransactions", cascade={"persist"})
     * @ORM\JoinColumn(name="credited_person_id", referencedColumnName="id")
     */
    protected $creditedPerson;

    /**
     * Transaction debited user
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User\User", inversedBy="debitedTransactions", cascade={"persist"})
     * @ORM\JoinColumn(name="debited_person_id", referencedColumnName="id")
     */
    protected $debitedPerson;

    /**
     * Transaction constructor.
     */
    function __construct()
    {
        $this->amount = 0;
        $this->creditedFunds = 0;
        $this->debitedFunds = 0;
        $this->currency = "EUR";

        $this->visibility = 0;
        $this->isProcessed = false;

        $this->transactionStatus = "UNKNOWN";
        $this->transactionType = "PAY";

        $this->subTransactions = new ArrayCollection();
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
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param mixed $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * @param string $transactionStatus
     */
    public function setTransactionStatus($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    /**
     * @return int
     */
    public function getTransactionType()
    {
        return $this->transactionType;
    }

    /**
     * @param int $transactionType
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getCreditedFunds()
    {
        return $this->creditedFunds;
    }

    /**
     * @param int $creditedFunds
     */
    public function setCreditedFunds($creditedFunds)
    {
        $this->creditedFunds = $creditedFunds;
    }

    /**
     * @return int
     */
    public function getDebitedFunds()
    {
        return $this->debitedFunds;
    }

    /**
     * @param int $debitedFunds
     */
    public function setDebitedFunds($debitedFunds)
    {
        $this->debitedFunds = $debitedFunds;
    }

    /**
     * @return int
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param int $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return mixed
     */
    public function getParentTransaction()
    {
        return $this->parentTransaction;
    }

    /**
     * @param mixed $parentTransaction
     */
    public function setParentTransaction($parentTransaction)
    {
        $this->parentTransaction = $parentTransaction;
    }

    /**
     * @return mixed
     */
    public function getSubTransactions()
    {
        return $this->subTransactions;
    }

    /**
     * @param mixed $subTransactions
     */
    public function setSubTransactions($subTransactions)
    {
        $this->subTransactions = $subTransactions;
    }

    /**
     * @return bool
     */
    public function isIsProcessed()
    {
        return $this->isProcessed;
    }

    /**
     * @param bool $isProcessed
     */
    public function setIsProcessed($isProcessed)
    {
        $this->isProcessed = $isProcessed;
    }

    /**
     * @return User
     */
    public function getCreditedPerson()
    {
        return $this->creditedPerson;
    }

    /**
     * @param User $creditedPerson
     */
    public function setCreditedPerson($creditedPerson)
    {
        $this->creditedPerson = $creditedPerson;
    }

    /**
     * @return User
     */
    public function getDebitedPerson()
    {
        return $this->debitedPerson;
    }

    /**
     * @param User $debitedPerson
     */
    public function setDebitedUser($debitedPerson)
    {
        $this->debitedPerson = $debitedPerson;
    }
}