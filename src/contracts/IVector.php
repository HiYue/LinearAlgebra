<?php
/**
 * Created by https://yue.dev
 * Author: Justin Wang
 * Email: hi@yue.dev
 */

namespace Yue\LinearAlgebra\contracts;

interface IVector
{
    const X = 0;
    const Y = 1;
    const Z = 2;

    public function dimension():int ;

    public function get($index);

    /**
     * Vector can add
     * @param IVector|null $v
     * @return IVector
     */
    public function add($v):IVector;

    /**
     * Vector can multiply a scala
     * @param int|float $scalaValue
     * @return IVector
     */
    public function multiply($scalaValue):IVector;

    /**
     * @param IVector|null $v
     * @return bool
     */
    public function equals($v):bool ;

    /**
     * Is all elements are zero
     * @return bool
     */
    public function isZeroVector():bool ;
}