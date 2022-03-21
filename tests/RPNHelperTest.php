<?php

nameSpace App\tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\RPNHelper;

class RPNHelperTest extends TestCase
{
    public $additionTests = [
        '2+2' => 4,
        '2+2+5' => 9,
        '2+0+5' => 7,
        '2+0+5+7+4+2+5+8+9+6+3+4+444555+898653+3' => 1343266,
        '0+0' => 0,
    ];

    public $substractionTests = [
        '4-2' => 2,
        '2-2-5' => -5,
        '5-0-2' => 3,
        '467582434-4675838-494-7665-21-3' => 462898413,
        '12-0' => 12,
        '0-0' => 0,
        '0-7' => -7,
    ];

    public $multiplicationTests = [
        '2*2' => 4,
        '4*5*10' => 200,
        '34*6*645*5*9*3*17' => 301976100,
        '34*6*645*5*9*3*17*0' => 0,
    ];

    public $divisionTests = [
        '4/2' => 2,
        '9/3/3' => 1,
        '1234568/45454/3' => 9.053607309954385,
        '0/194' => 0,
        '10/0' => 'Division by zero',
    ];

    public $priorityTests = [
        '2+2*3' => 8,
        '2+6/3' => 4,
        '2*2*3' => 12,
        '6/2*3' => 9,
        '(1+1)*2' => 4,
        '(1+1)*(2+4)' => 12,
    ];

    public $RPNadditionTests = [
        '2+2' => [2,2,'+'],
        '2+2+5' => [2,2,'+', 5, '+'],
        '2+0+5' => [2,0,'+',5, '+'],
        '2+0+5+7+4+2+5+8+9+6+3+4+444555+898653+3' => [2, 0, '+', 5, '+', 7, '+', 4, '+', 2, '+', 5, '+', 8, '+', 9, '+', 6, '+', 3, '+', 4, '+', 444555, '+', 898653, '+', 3, '+'],
        '0+0' => [0, 0, '+'],
    ];

    public $RPNsubstractionTests = [
        '4-2' => [4, 2, '-'],
        '2-2-5' => [2, 2, '-', 5, '-'],
        '5-0-2' => [5, 0, '-', 2, '-'],
        '467582434-4675838-494-7665-21-3' => [467582434, 4675838, "-", 494, "-", 7665, "-", 21, "-", 3, "-"],
        '12-0' => [12, 0, '-'],
        '0-0' => [0, 0, '-'],
        '0-7' => [0, 7, '-'],
    ];

    public $RPNmultiplicationTests = [
        '2*2' => [2, 2, '*'],
        '4*5*10' => [4, 5, '*', 10, '*'],
        '34*6*645*5*9*3*17' => [34, 6, "*", 645, "*", 5, "*", 9, "*", 3, "*", 17, "*"],
        '34*6*645*5*9*3*17*0' => [34, 6, "*", 645, "*", 5, "*", 9, "*", 3, "*", 17, "*", 0, '*'],
    ];

    public $RPNdivisionTests = [
        '4/2' => [4, 2, '/'],
        '9/3/3' => [9, 3, '/', 3, '/'],
        '1234568/45454/3' => [1234568, 45454, '/', 3, '/'],
        '0/194' => [0, 194, '/'],
        '10/0' => [10, 0, '/'],
    ];

    public $RPNpriorityTests = [
        '2+2*3' => [2, 2, 3, '*', '+'],
        '2+6/3' => [2, 6, 3, '/', '+'],
        '2*2*3' => [2, 2, '*', 3, '*'],
        '6/2*3' => [6, 2, '/', 3, '*'],
        '(1+1)*2' => [1, 1, '+', 2, '*'],
        '(1+1)*(2+4)' =>  [1, 1, "+", 2, 4, "+", "*"],
    ];

    public function testconvertToRPN()
    {
        $RPNHelper = new RPNHelper();

        // ADDITIONS
        foreach($this->RPNadditionTests as $addition => $result) {
            $this->assertEquals($result, $RPNHelper->convertToRPN($RPNHelper->splitOperation($addition)));
        }
        // SUBSTRACTIONS
        foreach($this->RPNsubstractionTests as $substraction => $result) {
            $this->assertEquals($result, $RPNHelper->convertToRPN($RPNHelper->splitOperation($substraction)));
        }
        // MULTIPLICATIONS
        foreach($this->RPNmultiplicationTests as $multiplication => $result) {
            $this->assertEquals($result, $RPNHelper->convertToRPN($RPNHelper->splitOperation($multiplication)));
        }
        // DIVISIONS
        foreach($this->RPNdivisionTests as $division => $result) {
            $this->assertEquals($result, $RPNHelper->convertToRPN($RPNHelper->splitOperation($division)));
        }
        // PRIORITIES
        foreach($this->RPNpriorityTests as $priority => $result) {
            $this->assertEquals($result, $RPNHelper->convertToRPN($RPNHelper->splitOperation($priority)));
        }
    }

    public function testCompute()
    {
        $RPNHelper = new RPNHelper();

        // ADDITIONS
        foreach($this->additionTests as $addition => $result) {
            $this->assertEquals($result, $RPNHelper->compute($addition));
        }
        // SUBSTRACTIONS
        foreach($this->substractionTests as $substraction => $result) {
            $this->assertEquals($result, $RPNHelper->compute($substraction));
        }
        // MULTIPLICATIONS
        foreach($this->multiplicationTests as $multiplication => $result) {
            $this->assertEquals($result, $RPNHelper->compute($multiplication));
        }
        // DIVISIONS
        foreach($this->divisionTests as $division => $result) {
            $this->assertEquals($result, $RPNHelper->compute($division));
        }
        // PRIORITIES
        foreach($this->priorityTests as $priority => $result) {
            $this->assertEquals($result, $RPNHelper->compute($priority));
        }
    }
}