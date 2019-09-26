<?php declare(strict_types=1);

namespace PROJ\Service;

class TemplateEngineService
{
    private $fileName;
    private $parameters;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

   public function setParameters(array $parametras){
        $this->parameters=$parametras;
   }

   public function render(){
       $Html =  file_get_contents($this->fileName);

        foreach ($this->parameters as $key=> $pr){
            $Html=str_replace("{{".$key."}}", $pr, $Html);
        };
        echo $Html;
   }
}