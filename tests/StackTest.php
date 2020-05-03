<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Exceptions\EmptyStackException;
use Src\Stack;
use Src\StackContract;

class StackTest extends TestCase
{
    private StackContract $stack;

    public function setUp()
    {
        $this->stack = new Stack();
    }

    /**
     * Tests for empty function
     */
    public function testEmptyStack()
    {
        $this->assertTrue($this->stack->empty());

        $this->stack->push(1);
        $this->assertFalse($this->stack->empty());
    }

    /**
     * Tests the pop functionality
     *
     * @throws EmptyStackException
     */
    public function testPop()
    {
        $this->stack->push(1);
        $this->stack->push(2);
        $this->stack->push(3);

        $this->assertSame(3, $this->stack->pop());
        $this->assertSame(2, $this->stack->pop());
        $this->assertSame(1, $this->stack->pop());

        $exception = null;
        try {
            $this->stack->pop();
        } catch (EmptyStackException $exception) {
        }

        $this->assertInstanceOf(EmptyStackException::class, $exception);
    }

    /**
     * Tests the top functionality
     *
     * @throws EmptyStackException
     */
    public function testTop()
    {
        $exception = null;
        try {
            $this->stack->top();
        } catch (EmptyStackException $exception) {
        }

        $this->assertInstanceOf(EmptyStackException::class, $exception);

        $this->stack->push(1);
        $this->stack->push(3);

        $this->assertSame(3, $this->stack->top());
        $this->assertSame(3, $this->stack->top());
    }

}