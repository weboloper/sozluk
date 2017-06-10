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
    public $content;

    /**
     *
     * @var integer
     */
    public $postId;

    /**
     *
     * @var integer
     */
    public $userId;

    /**
     *
     * @var integer
     */
    public $parentId;

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
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

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
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function getPostId()
    {
        return $this->postId;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getParentId()
    {
        return $this->parentId;
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
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function beforeValidationOnCreate()
    { 	
        $this->createdAt  = time();
        $this->modifiedAt = time();
        $this->parentId     = 0;
    	$this->type     	= self::TYPE_ENTRY;
    	$this->status     	= self::STATUS_PUBLISHED;
    	$this->deletedAt    = 0;
    	$this->ipAddress 	= $this->di->getRequest()->getClientAddress();
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
        $this->belongsTo('userId', Users::class, 'id', ['alias' => 'user', 'reusable' => true]);
    	$this->belongsTo('postId', Posts::class, 'id', ['alias' => 'post', 'reusable' => true]);
    }

}