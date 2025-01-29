<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PaginationResource extends ResourceCollection
{
    private $className;
    private $mutator;

    public function __construct($resourceClass, $resource, $mutator = null)
    {
        parent::__construct($resource);

        $this->className = $resourceClass;
        $this->mutator = $mutator;
    }

    public function toArray($request)
    {
        $this->collection->transform(function ($item) {
            $mutator = $this->mutator;

            if ($this->mutator)
                return (new $this->className($mutator($item)));
            else
                return (new $this->className($item));
        });

        return parent::toArray($request);
    }
}
