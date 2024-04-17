<?php
class enquiry
{
    private $id;
    private $name;
    private $email;
    private $phone;
    private $source;
    private $qualification;
    private $Status;
    private $enqueryFor;
    private $Modified_Date;
    private $enq_createdon;


    public function set_Id($IdValue)
    {
        $this->id = $IdValue;
    }

    public function get_Id()
    {
        return $this->id;
    }
    public function set_name($nameValue)
    {
        $this->name = $nameValue;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_email($emailValue)
    {
        $this->email = $emailValue;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_phone($phoneValue)
    {
        $this->phone = $phoneValue;
    }

    public function get_phone()
    {
        return $this->phone;
    }
    public function set_qualification($qualificationValue)
    {
        $this->qualification = $qualificationValue;
    }
    public function get_qualification()
    {
        return $this->qualification;
    }
    public function set_enqueryFor($enqueryForvalue)
    {
        $this->enqueryFor = $enqueryForvalue;
    }
    public function get_enqueryFor()
    {
        return $this->enqueryFor;
    }

    public function set_modifieddate($modifieddateValue)
    {
        $this->Modified_Date = $modifieddateValue;
    }
    public function get_modifieddate()
    {
        return $this->Modified_Date;
    }

    function set_enqcreatedon($enqcreatedonValue)
    {
        $this->enq_createdon = $enqcreatedonValue;
    }
    function get_enqcreatedon()
    {
        return $this->enq_createdon;
    }



    /**
     * Get the value of Status
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Set the value of Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;

        return $this;
    }

    /**
     * Get the value of source
     */
    public function get_Source()
    {
        return $this->source;
    }

    /**
     * Set the value of source
     */
    public function set_Source($source): self
    {
        $this->source = $source;

        return $this;
    }
}
