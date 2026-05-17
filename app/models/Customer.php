<?php
// classes/Customer.php
class Customer
{
    /** @var string */
    public string $name;
    /** @var string */
    public string $phone;
    /** @var string */
    public string $type; // VangLai, VIP, KhachQuen

    public function __construct(string $name, string $phone, string $type = 'VangLai')
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->type = $type;
    }

    public function getDiscountRate()
    {
        switch ($this->type) {
            case 'VIP':
                return 0.15; // Giảm 15%
            case 'KhachQuen':
                return 0.05; // Giảm 5%
            default:
                return 0.0; // Khách vãng lai không giảm
        }
    }
}
