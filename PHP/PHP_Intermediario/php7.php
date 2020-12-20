<?php

/**
 * Methods accepts bool, float, int and string types
 */
function get(float $a) { /* code */};

/**
 * Null coalescing operator
 * Replace the statement 
 * $a = isset($var) ? $var : "error";
 */
$a = $var ?? "error";

/**
 * Spaceship operator
 */
echo 3 <=> 3; //0
echo 2 <=> 3; //-1
echo 3 <=> 2; //1

echo 3.4 <=> 3.4; //0 -> both are equal

echo "a" <=> "b"; //-1 a is lower

echo [1,2,3] <=> [1,1]; //1 first array is bigger

echo [1,2,3] <=> [1,2,4]; //-1 first array is lower

/**
 * Const arrays
 */
define('ANIMALS',['dog','cat','bird']);

/**
 * If a method has the same name of the class, this will give us a warning, but this was considered constructors in previous versions
 */
class Log{
    public function log() { /*code*/ }      
}

/**
 * Anonymous class
 */
//$app = new App();
//$app->setLogger(new class implements Logger{
//    public function log() {/* code */}
//});

/**
 * Closure Calls
 */
class A{
    private $x = 1;
}

$getX = function(){
    return $this->x;
};

echo $getX->call(new A);

/**
 * Unserialize filtered
 */
$arr = ['aaa' => 1, 'bbb' => 2];
$serialize = serialize($arr); //Stores "a:2:{s:3:"aaa";i:1;s:3:"bbb";i:2;}"
$unserialize = unserialize($serialize,["allowed_classes" => ["bbb"]]); 
var_dump($unserialize); //if bbb is a class will return just bbb

/**
 * Declaration of namespaces
 */
use some\namespace\{
    ClassA, ClassB, ClassC as c
};

use function some\namespace\{fn_a, fn_b, fn_c};

use const some\namespace\{constA, constB, constC};

/**
 * intdiv, returns always an integer value of a division
 */
$a = intdiv(43.5,2);

/**
 * Interface throwable
 */
interface myThrowPack extends Throwable{}
class myExceptPack extends Error implements myThrowPack {}
function add(int $left, int $right){
    if($left<0) {
        throw new myExceptPack("Left < 0");
    }
    return $left + $right;
}

try{
    echo add(-1,5);
} catch(Exception $e) {
    echo "Exception " . $e->getMessage();
} catch(Error $e) {
    echo "Error " . $e->getMessage();
}

/**
 * nullable function, int this case the return type can be both int or null
 * the second example shows that parameter x can be int or null
 */
function sum($x) : ?int;
function sum(?int $x) : ?int;

/**
 * array destructuring
 */
$array2 = ['index1' => 'a', 'index2' => 'b'];
[$x, $y] = $array2; //give array content to independents vars
['index1' => $x, 'index2' => $y] = $array2;//give array content to independents vars

/**
 * Access control to consts
 */
class Car {
    const C_TYPE = "Normal";
    private const C_TYPEX = "x";
    protected const C_TYPEY = "y";
}

