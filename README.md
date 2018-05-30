# KAMI RequestProcessor

## Abstract
Intention of this component is providing more abstract layer
to handling http requests. Utilizing `Strategy` pattern, this
`RequestProcessor` gives you possibility to dramatically reduce
amount of repeating code in your applications

## Installation
```bash
composer require kami/request-processor
```

# Usage
Firstly you will need your steps extending `RequestProcessor\AbstractStep`

```php
<?php

use Kami\Component\RequestProcessor\Step\AbstractStep;
use Symfony\Component\HttpFoundation\Request;
use Kami\Component\RequestProcessor\ArtifactCollection;

class MyAwesomeStep extends AbstractStep
{
    public function execute(Request $request) : ArtifactCollection 
    {
        /** Your execute method */
    }
    public function getRequiredArtifacts() : array 
    {
        return ['some_artifact'];
    }
    
}
```
Build up your strategy

```php
<?php

use Kami\Component\RequestProcessor\AbstractStrategy;

class MyStrategy extends AbstractStrategy
{
    public static function getSteps() : array 
    {
        return [
            new MyAwesomeStep(),
            new MyAnotherStep()    
        ];
    }
}
```

The one and the only requirement for your strategy 
is it should end up with at least two artifacts 
`data` and `status`

