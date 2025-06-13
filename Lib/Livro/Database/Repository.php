<?php
namespace Livro\Database;

use Livro\Database\Criteria;
use Livro\Database\Query;

class Repository extends Query
{
    private $activeRecord;

    public function __construct($class)
    {
        $this->activeRecord = $class;
    }

    public function load(Criteria $criteria)
    {
        $sql = "SELECT * FROM " . constant($this->activeRecord . '::TABLENAME');
    
        if($criteria)
        {
            $expression = $criteria->dump();
            if($expression && $expression !== '()')
            {
                $sql .= 'WHERE ' . $expression;
            }

            $order = $criteria->getProperty('order');
            $limit = $criteria->getProperty('limit');
            $offset = $criteria->getProperty('offset');

            if($order)
            {
                $sql .= ' ORDER BY ' . $order;
            }

            if($limit)
            {
                $sql .= ' LIMIT ' . $limit;
            }

            if ($offset)
            {
                $sql .= ' OFFSET ' . $offset;
            }
        }
        $conn = self::setConnection();
        $result = $conn->query($sql);
        $results = [];
        while ($row = $result->fetch_object($this->activeRecord))
        {
            $results[] = $row;
        }
        return $results;
    }

    public function delete(Criteria $criteria)
    {
        $sql = "DELETE FROM " .  constant($this->activeRecord . '::TABLENAME');

         $expression = $criteria->dump();
            if($expression)
            {
                $sql .= 'WHERE ' . $expression;
            }
        $conn = self::setConnection();
        return $conn->exec($sql);
    }

    public function count(Criteria $criteria)
    {
          $sql = "SELECT count(*) FROM " .  constant($this->activeRecord . '::TABLENAME');

            $expression = $criteria->dump();
            if($expression)
            {
                $sql .= 'WHERE ' . $expression;
            }
             $conn = self::setConnection();
            $result = $conn->query($sql);

            if($result)
            {
                $row = $result->fetch_row();
        
                return $row[0];
            }
    }
}