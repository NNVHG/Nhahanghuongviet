<?php
// classes/User.php
abstract class User
{
    /** @var int */
    protected int $id;
    /** @var string */
    protected string $fullName;
    /** @var string */
    protected string $role;

    public function __construct(int $id, string $fullName, string $role)
    {
        $this->id = $id;
        $this->fullName = $fullName;
        $this->role = $role;
    }

    abstract public function getPermissions();
}

class Manager extends User
{
    public function __construct(int $id, string $fullName, string $role)
    {
        parent::__construct($id, $fullName, $role); // GiamDoc, TruongPhong...
    }

    public function getPermissions()
    {
        return ["quản lý nhân sự", "xem báo cáo thống kê", "quản lý kho"];
    }
}

class Employee extends User
{
    public function __construct(int $id, string $fullName, string $role)
    {
        parent::__construct($id, $fullName, $role); // ThuNgan, PhucVu...
    }

    public function getPermissions()
    {
        if ($this->role == 'ThuNgan') return ["thanh toán", "lập hóa đơn"];
        if ($this->role == 'PhucVu') return ["ghi nhận order", "quản lý bàn"];
        return ["công việc dọn dẹp"];
    }
}
