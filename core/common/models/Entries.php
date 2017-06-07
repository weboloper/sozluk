<?php
namespace Weboloper\Models;

use Phalcon\Mvc\Model;
use Weboloper\Models\Users;
use Weboloper\Models\Posts;

/**
 * Weboloper\Models\Posts
 * All the users registered in the application
 */
class Entries extends Model
{

	const TYPE_ENTRY          = 'entry';

	const STATUS_PUBLISHED    = 'published';
	const STATUS_UNPUBLISHED  = 'unpublished';
	const STATUS_TRASH        = 'trash';

	/**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $body;

    /**
     *
     * @var integer
     */
    public $usersId;

    /**
     *
     * @var string
     */
    public $type;

    /**
     *
     * @var string
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     *
     * @var integer
     */
    public $modifiedAt;

    /**
     *
     * @var integer
     */
    public $deletedAt;

    /**
     *
     * @var string
     */
    public $ipAddress;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
    public function setUsersId($usersId)
    {
        $this->usersId = $usersId;

        return $this;
    }
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getUsersId()
    {
        return $this->usersId;
    }
    public function getType()
    {
        return $this->type = $type;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getCreatedAt()
    {
        return $this->createdAt;

    }
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
    public function getIpaddress()
    {
        return $this->ipaddress;
    }


    public function beforeValidationOnCreate()
    { 	
    	$this->type     	= TYPE_ENTRY;
    	$this->status     	= STATUS_PUBLISHED;
    	$this->deletedAt    = 0;
    	$this->ipaddress 	= $this->getDI()->getRequest()->getClientAddress();
    }

    public function beforeCreate()
    {
    	$this->createdAt  = time();
        $this->modifiedAt = time();
    }

    public function beforeUpdate()
    {
        $this->modifiedAt = time();
    }

    public function initialize()
    {
        $this->belongsTo('usersId', Users::class, 'id', ['alias' => 'user', 'reusable' => true]);
    	$this->belongsTo('postsId', Posts::class, 'id', ['alias' => 'post', 'reusable' => true]);
    }

}