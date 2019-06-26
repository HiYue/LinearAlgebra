<?php
/**
 * Created by https://yue.dev
 * Author: Justin Wang
 * Email: hi@yue.dev
 */
use Yue\LinearAlgebra\contracts\IVector;
use Yue\LinearAlgebra\impl\Vector;

class BasicVectorTest extends \PHPUnit\Framework\TestCase
{
    public function testVectorSatisfyRules(){
        $u = $this->getVector();
        $v = $this->getVector();
        $w = $this->getVector();
        $k = rand(2,100);
        $c = rand(101,200);

        // u + v = v + u
        $a1 = $u->add($v);
        $a2 = $v->add($u);
        $this->assertTrue($a1->equals($a2));

        // ( u + v ) + w = u + (v + w)
        $b1 = $u->add($v);
        $b2 = $b1->add($w);
        $b3 = $v->add($w);
        $b4 = $u->add($b3);
        $this->assertTrue($b2->equals($b4));

        // k(u+v) = ku + kv
        $e1 = $u->add($v)->multiply($k); // k(u+v)
        $e2 = $u->multiply($k)->add($v->multiply($k)); // ku + kv

        $this->assertTrue($e1->equals($e2));

        // (k+c)u = ku + cu
        $d1 = $u->multiply($k + $c);
        $d2 = $u->multiply($k)->add($u->multiply($c));
        $this->assertTrue($d1->equals($d2));

        // (kc)u = k(cu)
        $x1 = $u->multiply($k * $c);
        $x2 = $u->multiply($c)->multiply($k);
        $this->assertTrue($x1->equals($x2));

        // 1u = u
        $y = $u->multiply(1);
        $this->assertTrue($y->equals($u));
    }

    public function testVectorEquals(){
        $u = $this->getVector([2,4]);
        $v = $this->getVector([3,5]);
        $w = $this->getVector([3,5]);

        $this->assertTrue($v->equals($w));
        $this->assertTrue($w->equals($v));
        $this->assertFalse($u->equals($v));
    }

    public function testVectorCanMultiplyScala(){
        $v1 = $this->getVector([2,4]);
        $v2 = $v1->multiply(5);
        $this->assertEquals(10,$v2->get(0));
        $this->assertEquals(20,$v2->get(1));
    }

    public function testVectorCanAddVector(){
        $v1 = $this->getVector([2,4]);
        $v2 = $this->getVector([2,4]);
        $v3 = $v1->add($v2);

        $this->assertEquals(4,$v3->get(0));
        $this->assertEquals(8,$v3->get(1));

        $v4 = $this->getVector([2,4,8]);
        $v5 = $this->getVector([2,4]);
        $v6 = $v4->add($v5);

        $this->assertEquals(4,$v6->get(0));
        $this->assertEquals(8,$v6->get(1));
        $this->assertEquals(8,$v6->get(2));

        $v7 = $v6->add(null);
        $this->assertEquals(4,$v7->get(0));
        $this->assertEquals(8,$v7->get(1));
        $this->assertEquals(8,$v7->get(2));
    }

    public function testGetItemByIndex(){
        $v = $this->getVector([2,4]);
        $this->assertEquals(2, $v->get(0));
        $this->assertEquals(2, $v->get(IVector::X));
        $this->assertEquals(4, $v->get(1));
        $this->assertEquals(4, $v->get(IVector::Y));

        $this->assertNull($v->get(2));
        $this->assertNull($v->get(IVector::Z));
    }

    public function testVectorLength(){
        $len = rand(1,10);
        $v = $this->getVector($len);
        $this->assertEquals($len, count($v));
        $this->assertEquals($len, $v->dimension());
    }

    public function testVectorToString(){
        $v = $this->getVector([2,4]);
        $this->assertEquals('Vector [(2, 4)]', ''.$v);
    }

    /**
     * Generate a vector
     * @param null $val
     * @return Vector
     */
    protected function getVector($val = null){
        if(is_array($val)){
            return new Vector($val);
        }
        elseif (is_int($val)){
            $maxNumber = 1000;
            $data = [];
            for($i=0;$i<$val;$i++){
                $data[] = rand(1,$maxNumber);
            }
            return new Vector($data);
        }
        elseif (is_null($val)){
            $maxNumber = 1000;
            $len = rand(2,10);
            $data = [];
            for($i=0;$i<$len;$i++){
                $data[] = rand(1,$maxNumber);
            }
            return new Vector($data);
        }
    }
}