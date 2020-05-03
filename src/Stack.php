<?php

namespace Src;

use SplQueue;
use Src\Exceptions\EmptyStackException;

/**
 * Class Stack
 *
 * Stack implementation using queue as underlying data-structure
 */
class Stack implements StackContract
{
    private SplQueue $queue;

    /**
     * Stack constructor.
     *
     */
    public function __construct()
    {
        $this->queue = new SplQueue();
    }

    /**
     * @param mixed $data
     *
     */
    public function push($data): void
    {
        $this->queue->enqueue($data);

        /*
         * Re-order the queue, so its a valid stack for popping and topping
         */
        $totalElements = count($this->queue);
        while ($totalElements > 1) {
            $this->queue->enqueue($this->queue->dequeue());
            $totalElements--;
        }
    }

    /**
     * @return mixed
     * @throws EmptyStackException
     */
    public function pop()
    {
        try {
            return $this->queue->dequeue();
        } catch (\RuntimeException $exception) {
            throw new EmptyStackException('Cannot pop an empty stack');
        }
    }

    /**
     * @return mixed
     * @throws EmptyStackException
     */
    public function top()
    {
        try {
            // Bottom item of queue is the top item of stack
            return $this->queue->bottom();
        } catch (\RuntimeException $exception) {
            throw new EmptyStackException('Cannot get top of empty stack');
        }
    }

    /**
     * @return bool
     */
    public function empty(): bool
    {
        return $this->queue->isEmpty();
    }
}