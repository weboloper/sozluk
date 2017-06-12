<?php
namespace Weboloper\Models;

use Phalcon\Mvc\Model;
use Weboloper\Models\Users;
use Weboloper\Models\ModelBase;

/**
 * Weboloper\Models\Posts
 * All the users registered in the application
 */
class Posts extends ModelBase
{

	const TYPE_POST        = 'post';
	const TYPE_PAGE        = 'page';

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
    public $title;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var integer
     */
    public $userId;

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
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;

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
    public function getTitle()
    {
        return $this->title;
    }
    public function getSlug()
    {
        return $this->slug;
    }
    public function getUserId()
    {
        return $this->userId;
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
    { 	$this->createdAt  = time();
        $this->modifiedAt = time();
    	$this->type     	= self::TYPE_POST;
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
    }


    public static function getNewPosts($limit = 7, $offset = 0 )
    {
        $status = self::STATUS_PUBLISHED;
        $posts  = Posts::query()
            ->where("status = '{$status}'")
            ->orderBy('modifiedAt DESC')
            ->limit($limit, $offset)
            ->execute();
        if ($posts->valid()) {
            return $posts;
        }
        return false;
    }


    public static function getHotPosts($limit = 7, $offset = 0 )
    {
        $status = self::STATUS_PUBLISHED;
        $posts  = Posts::query()
            ->join(__NAMESPACE__ . "\Entries", "e.postId =  " . __NAMESPACE__ . "\Posts.id", "e", "LEFT")
            // ->where("status = '{$status}'")
            ->orderBy('e.modifiedAt DESC')
            ->limit($limit, $offset)
            ->execute();
        if ($posts->valid()) {
            return $posts;
        }
        return false;
    }



}