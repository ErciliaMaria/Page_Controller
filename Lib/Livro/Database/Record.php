<?php
namespace Livro\Database;

use Exception;

abstract class Record
{
    protected $data;
    private static $conn;

    public function __construct($id = null)
    {
        if ($id) {
            $object = $this->load($id);
            if ($object) {
                $this->fromArray($object->toArray());
            }
        }
    }

    public static function setConnection()
    {
        if (empty(self::$conn)) {
            $ini = parse_ini_file('App/Config/livro.ini');
            $host = $ini['DB1_HOST'];
            $name = $ini['DB1_NAME'];
            $user = $ini['DB1_USER'];
            $pass = $ini['DB1_PASSWORD'];
            self::$conn = new \mysqli($host, $user, $pass, $name, 3306);
            if (self::$conn->connect_error) {
                die("Erro de conexão: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
    public function __set($prop, $value)
    {
        if ($value === NULL) {
            unset($this->data[$prop]);
        } else {
            $this->data[$prop] = $value;
        }
    }
    public function __get($prop)
    {
        if (isset($this->data->$prop)) {
            return $this->data[$prop];
        }
    }
    public function __isset($prop)
    {
        return isset($this->data[$prop]);
    }

    public function __clone()
    {
        unset($this->data['id']);
    }

    public function fromArray($data)
    {
        $this->data = $data;
    }

    public function toArray()
    {
        return json_encode($this->data);
    }

    public function getEntity()
    {
        $class = get_class($this);

        return constant("{$class}::TABLENAME");
    }

    public function load($id)
    {
        if (empty(self::$conn)) {
            self::setConnection();
        }

        $sql = "SELECT * FROM {$this->getEntity()} WHERE id= ?";

        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            return $result->fetch_object(get_class($this));
        }
    }
    public function store()
    {
        if (empty(self::$conn)) {
            self::setConnection();
        }
        if (empty($this->data['id'])) {
            $fields = array_keys($this->data);
            $placeholders = array_fill(0, count($fields), '?');
            $values = array_values($this->data);

            $sql = "INSERT INTO {$this->getEntity()} (" . implode(',', $fields) . ") VALUES (" . implode(',', $placeholders) . ")";

            $stmt = self::$conn->prepare($sql);
            $types = $this->getParamTypes($values);

            $stmt->bind_param($types, ...$values);

            $stmt->execute();

            $this->data['id'] = self::$conn->insert_id;

            $stmt->close();
        } else {
            $fields = [];
            $values = [];
            foreach ($this->data as $field => $value) {
                if ($field != 'id') {
                    $fields[] = "$field = ?";
                    $values[] = $value;
                }
            }
            $values[] = $this->data['id'];

            $sql = "UPDATE {$this->getEntity()} SET " . implode(', ', $fields) . " WHERE id = ?";

            $stmt = self::$conn->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Erro na preparação da consulta: " . self::$conn->error);
            }
            $types = $this->getParamTypes($values);

            $stmt->bind_param($types, ...$values);

            $stmt->execute();
            $stmt->close();
        }
    }
    protected function getParamTypes(array $values): string
    {
        $types = '';
        foreach ($values as $value) {
            if (is_int($value)) {
                $types .= 'i';
            } elseif (is_float($value)) {
                $types .= 'd';
            } elseif (is_null($value)) {
                $types .= 's';
            } else {
                $types .= 's';
            }
        }
        return $types;
    }
    public static function find($id)
    {
        $classname = get_called_class();
        $ar = new $classname();
        $object = $ar->load($id);
        if ($object) {
            return $object;
        }
    }
}
