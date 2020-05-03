<?php

namespace Aamir\Stack\Src;

interface StackContract {

    public function push($data): void;

    public function pop();

    public function top();

    public function empty(): bool;
}