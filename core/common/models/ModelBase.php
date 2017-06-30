<?php

namespace Weboloper\Models;

use Phalcon\Mvc\Model;
// use Phanbook\Tools\ZFunction;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
// use Phanbook\Models\Behavior\Blameable as ModelBlameable;

use Weboloper\Models\Entries;
use Weboloper\Models\Posts;
 
 
class ModelBase extends Model
{
    const OBJECT_POSTS = 'posts';
    const OBJECT_ENTRIES = 'entries';

    public static function getBuilder()
    {
        $di = FactoryDefault::getDefault();
        return $di->get('modelsManager')->createBuilder();
    }
 


    // public function getEntries($postsId, $type)
    // {
    //     $resultset = $this->getBuilder()
    //         ->from(array('e' => __NAMESPACE__ . '\Entries'))
    //         ->join( __NAMESPACE__ . '\Users', "u.id= e.usersId", 'u')
    //         ->columns(['e.id, e.content, e.usersId, e.createdAt, u.username '])
    //         ->where('postsId = :postsId:')
    //         ->andWhere('type = :type:')
    //         ->getQuery()
    //         ->execute(['type' => $type, 'postsId' => $postsId])->toArray();
    //     return $resultset;
    // }

    public static function prepareQueriesPosts($join, $where, $limit = 15 , $type = 'entry')
    {
        $modelNamespace = __NAMESPACE__ . '\\' ;
        /**
         *
         * @var \Phalcon\Mvc\Model\Query\BuilderInterface $itemBuilder
         */
        $itemBuilder = self::getBuilder()
            ->from(['e' => Entries::class])
            ->join($modelNamespace."Posts", "e.postId = p.id", "p")
            ->join($modelNamespace."Users", "p.userId = u.id", "u");
            
        if (isset($join) && is_array($join)) {
            $type = (string) $join['type'];
            $itemBuilder->$type($modelNamespace . $join['model'], $join['on'], $join['alias']);
        }
        if (isset($where)) {
            $itemBuilder->where($where);
        }

        if($type == 'post'){
            
            $setColumns = array('p.id as pId, p.title as pTitle, p.slug as pSlug, u.username as uUsername, u.id as uId,   p.createdAt as feedDate');
        }else {
            $setColumns = array('p.id as pId, p.title as pTitle, p.slug as pSlug, u.username as uUsername, u.id as uId, max(e.modifiedAt) as feedDate  ');
        }

        $itemBuilder
            ->columns( $setColumns )
            ->limit($limit);
       
        return $itemBuilder;
    }


    public static function prepareQueriesEntries($join, $where, $limit = 15)
    {
        $modelNamespace = __NAMESPACE__ . '\\' ;
        /**
         *
         * @var \Phalcon\Mvc\Model\Query\BuilderInterface $itemBuilder
         */
        $itemBuilder = self::getBuilder()
            ->from(['e' => Entries::class])
            ->orderBy('e.createdAt ASC');
        if (isset($join) && is_array($join)) {
            $type = (string) $join['type'];
            $itemBuilder->$type($modelNamespace . $join['model'], $join['on'], $join['alias']);
        }
        if (isset($where)) {
            $itemBuilder->where($where);
        }
        $totalBuilder = clone $itemBuilder;
        $itemBuilder
            ->columns(array('e.*'))
            ->limit($limit);
        $totalBuilder
            ->columns('COUNT(*) AS count');
        return array($itemBuilder, $totalBuilder);
    }


    public static function getPosts($limit = 7, $offset = 0 )
    {
        // $status = self::STATUS_PUBLISHED;
        $posts  = Entries::query()
            ->join(__NAMESPACE__ . "\Posts", "p.id =  " . __NAMESPACE__ . "\Entries.postId", "p", "LEFT")
            // ->where("status = '{$status}'")
            // ->orderBy('max('. __NAMESPACE__ . '\Entries.modifiedAt) DESC')
            ->limit($limit, $offset)
            ->execute();
        if ($posts->valid()) {
            return $posts;
        }
        return false;
    }

    public static function getFeed($limit, $offset, $solframe)
    {   
        $modelNamespace = __NAMESPACE__ . '\\' ;
        $di = FactoryDefault::getDefault();
        
        switch ($solframe) {
            case 'newposts':
                $query = $di->get('modelsManager')->createQuery('SELECT * FROM '.$modelNamespace.'Posts 
                                                        LIMIT  {limit:int} OFFSET {offset:int}  ');
                break;
            
            default:
                #newentries
                $query = $di->get('modelsManager')->createQuery('SELECT title, username , max(e.modifiedAt) as mod 
                                                        FROM '.$modelNamespace.'Entries AS e
                                                        LEFT JOIN '.$modelNamespace.'Posts AS p ON p.id = e.postId 
                                                        LEFT JOIN '.$modelNamespace.'Users AS u ON u.id = e.userId 
                                                        GROUP BY e.postId, e.userId
                                                        ORDER BY mod DESC
                                                        LIMIT  {limit:int} OFFSET {offset:int}  ');
                break;
        }
        

        $posts = $query->execute( array('limit' => $limit , 'offset' => $offset ) );

        return $posts;
    }


}