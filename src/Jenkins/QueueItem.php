<?php

namespace RodrigoRoss\Jenkins;

use RodrigoRoss\Jenkins;

class QueueItem
{

    /**
     * @var \stdClass
     */
    private $queueItem;


    /**
     * @var Jenkins
     */
    protected $jenkins;

    /**
     * @param \stdClass $queueItem
     * @param Jenkins   $jenkins
     */
    public function __construct($queueItem, Jenkins $jenkins)
    {
        $this->queueItem = $queueItem;
        $this->setJenkins($jenkins);
    }

    /**
     * @return array
     */
    public function getInputParameters()
    {
        $parameters = array();

        if (!property_exists($this->queueItem->actions[0], 'parameters')) {
            return $parameters;
        }

        foreach ($this->queueItem->actions[0]->parameters as $parameter) {
            $parameters[$parameter->name] = $parameter->value;
        }

        return $parameters;
    }

    /**
     * @return string
     */
    public function getJobName()
    {
        return $this->queueItem->task->name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->queueItem->id;
    }

    /**
     * @return int
     */
    public function getBuildNumber()
    {
        $buildId = null;

        if (!property_exists($this->queueItem->executable, 'number')) {
            return $buildId;
        }

        return $this->queueItem->executable->number;
    }

    /**
     * @return int
     */
    public function getBuildUrl()
    {
        $buildUrl = null;

        if (!property_exists($this->queueItem->executable, 'url')) {
            return $buildUrl;
        }
        
        return $this->queueItem->executable->url;
    }

    // /**
    //  * @return void
    //  */
    // public function cancel()
    // {
    //     $this->getJenkins()->cancelQueue($this);
    // }

    /**
     * @return Jenkins
     */
    public function getJenkins()
    {
        return $this->jenkins;
    }

    /**
     * @param Jenkins $jenkins
     */
    public function setJenkins(Jenkins $jenkins)
    {
        $this->jenkins = $jenkins;

        return $this;
    }
}
