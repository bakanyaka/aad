<?php


namespace App\Repositories\Ad;


use Adldap\Contracts\AdldapInterface;
use Adldap\Models\OrganizationalUnit;
use Adldap\Objects\DistinguishedName;
use App\Models\Ad\Department;
use App\Repositories\IDepartmentRepository;

class AdDepartmentRepository implements IDepartmentRepository
{
    const DEP_NAME_PATTERN = '#^(\d{3}(?:\/\d{3})?)\s[А-яё\s\(\),\d№-]+$#u';

    /**
     * @var AdldapInterface
     */
    private $adldap;

    /**
     * @var \Adldap\Query\Builder
     */
    private $search;


    /**
     * @var array
     */
    private $departmentsOU;

    /**
     * AdDepartmentRepository constructor.
     * @param AdldapInterface $adldap
     */
    public function __construct(AdldapInterface $adldap)
    {
        $this->adldap = $adldap->getDefaultProvider();
        $this->departmentsOU = config('adldap.departments_ou');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        $dn = new DistinguishedName($this->search()->getDn());
        foreach ($this->departmentsOU as $departmentOu) {
            $dn->addOu($departmentOu);
        }
        return $this->getDepartmentsFromOU($this->search()->findByDn($dn));
    }

    private function search() {
        return $this->search = $this->adldap->search()->ous();
    }

    private function getDepartmentsFromOU(OrganizationalUnit $ou) {
        return $this->search()->setDn($ou->getDn())->get()->slice(1)->map(function ($departmentOU) {
            return $this->mapDepartmentOuToDepartment($departmentOU);
        })->sortBy('slug');
    }

    /**
     * @param OrganizationalUnit $ou
     * @return Department
     */
    private function mapDepartmentOuToDepartment(OrganizationalUnit $ou) {
        $department = new Department();
        $department->name = $ou->getName();
        if (preg_match(self::DEP_NAME_PATTERN, $department->name, $matches)) {
            $department->slug = $matches[1];
        } else {
            $department->slug = str_slug($department->name, '_');
        }
        return $department;
    }
}