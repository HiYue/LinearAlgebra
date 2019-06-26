<?php
/**
 * Created by https://yue.dev
 * Author: Justin Wang
 * Email: hi@yue.dev
 */

namespace Yue\LinearAlgebra\impl;

use Yue\LinearAlgebra\contracts\IVector;
use Countable;

class Vector implements IVector, Countable
{
    private $_values;

    public function __construct($data)
    {
        $this->_values = $data;
    }

    /**
     * @return bool
     */
    public function isZeroVector(): bool
    {
        $result = true;

        for ($i=0;$i<$this->dimension();$i++){
            if($this->get($i) !== 0){
                $result = false;
                break;
            }
        }

        return $result;
    }


    /**
     * @param null|IVector $v
     * @return bool
     */
    public function equals($v): bool
    {
        if(is_null($v)){
            return false;
        }
        elseif ($this->dimension() !== $v->dimension()){
            return false;
        }
        else{
            $result = true;
            for ($i = 0; $i < $this->dimension(); $i++){
                if($this->get($i) !== $v->get($i)){
                    $result = false;
                    break;
                }
            }
            return $result;
        }
    }

    /**
     * @param float|int $scalaValue
     * @return IVector
     */
    public function multiply($scalaValue): IVector
    {
        $len = $this->dimension();

        $data = [];

        for ($i=0;$i<$len;$i++){
            $data[] = $this->get($i) * $scalaValue;
        }

        return new Vector($data);
    }


    /**
     * Vector can another vector
     *
     * @param null|IVector $v
     * @return IVector
     */
    public function add($v): IVector
    {
        if(is_null($v)){
            return $this;
        }

        $len = $this->dimension() >= $v->dimension() ? $this->dimension() : $v->dimension();

        $data = [];

        for ($i=0;$i<$len;$i++){
            $a = $this->get($i)??0;
            $b = $v->get($i)??0;
            $data[] = $a+$b;
        }

        return new Vector($data);
    }

    /**
     * @param $index
     * @return int|float|null
     */
    public function get($index)
    {
        return $this->_values[$index] ?? null;
    }

    /**
     * Get dimension
     * @return int
     */
    public function dimension(): int
    {
        return count($this);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->_values);
    }


    public function __toString()
    {
        return 'Vector [('.implode(', ',$this->_values).')]';
    }
}