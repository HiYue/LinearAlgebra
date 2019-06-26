<?php
/**
 * Created by https://yue.dev
 * Author: Justin Wang
 * Email: hi@yue.dev
 */

namespace Yue\LinearAlgebra;

use Yue\LinearAlgebra\impl\Vector;
use Yue\LinearAlgebra\contracts\IVector;

class SpecialVectorBuilder
{
    /**
     * 获取指定维度的标准单位向量
     *
     * @param int $dimension
     * @return IVector[]
     */
    public static function GetStandardUnitVectors(int $dimension){
        /**
         * @var IVector[] $data
         */
        $data = [];
        for ($i = 0;$i < $dimension; $i++){
            $item = array_fill(0,$dimension,0);
            $item[$i] = 1;
            $data[] = new Vector($item);
        }
        return $data;
    }

    /**
     * 获取指定维度的标准零向量
     *
     * @param int $dimension
     * @return IVector[]
     */
    public static function GetZeroVector(int $dimension){
        /**
         * @var IVector[] $data
         */
        $data = [];
        for ($i = 0;$i < $dimension; $i++){
            $item = array_fill(0,$dimension,0);
            $data[] = new Vector($item);
        }
        return $data;
    }
}