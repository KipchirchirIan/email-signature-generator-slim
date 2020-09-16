<?php
/**
 * Created by PhpStorm.
 * Author: Ian Kipchirchir
 * Date: 5/15/20
 * Time: 10:24 AM
 */

namespace App\Domain\Template\Data;


use Selective\ArrayReader\ArrayReader;

/**
 * Class TemplateCreatorData
 * @package App\Domain\Template\Data
 */
final class TemplateCreatorData
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $filename;

    /**
     * TemplateCreatorData constructor.
     *
     * @param array $array The template
     */
    public function __construct(array $array = [])
    {
        $data = new ArrayReader($array);

        $this->id = $data->findInt('template_id');
        $this->name = $data->findString('template_name');
        $this->description = $data->findString('template_desc');
        $this->filename = $data->findString('template_filename');
    }
}