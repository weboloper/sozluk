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

    public function getEntries($postsId, $type)
    {
        $resultset = $this->getBuilder()
            ->from(array('e' => __NAMESPACE__ . '\Entries'))
            ->join( __NAMESPACE__ . '\Users', "u.id= e.usersId", 'u')
            ->columns(['e.id, e.content, e.usersId, e.createdAt, u.username '])
            ->where('postsId = :postsId:')
            ->andWhere('type = :type:')
            ->getQuery()
            ->execute(['type' => $type, 'postsId' => $postsId])->toArray();
        return $resultset;
    }

    public static function prepareQueriesPosts($join, $where, $limit = 15)
    {
        $modelNamespace = __NAMESPACE__ . '\\' ;
        /**
         *
         * @var \Phalcon\Mvc\Model\Query\BuilderInterface $itemBuilder
         */
        $itemBuilder = self::getBuilder()
            ->from(['p' => Posts::class])
            ->orderBy('p.createdAt ASC');
        if (isset($join) && is_array($join)) {
            $type = (string) $join['type'];
            $itemBuilder->$type($modelNamespace . $join['model'], $join['on'], $join['alias']);
        }
        if (isset($where)) {
            $itemBuilder->where($where);
        }
        $itemBuilder
            ->columns(array('p.*'))
            ->limit($limit);
       
        return array($itemBuilder );
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


}